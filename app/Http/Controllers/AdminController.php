<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Osis;
use App\Models\Pemilu;
use Illuminate\Http\Request;
use App\Http\Requests\KetuaRequest;
use App\Http\Requests\PemiluRequest;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PemilihRequest;
use App\Models\DapilModel;
use Illuminate\Support\Facades\Crypt;
use App\Repositories\PemiluRepositories;
use App\Repositories\PemilihRepositories;
use PDF;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected $pemiluRepositories;
    protected $pemilihRepositories;

    public function __construct(PemiluRepositories $pemiluRepositories, PemilihRepositories $pemilihRepositories)
    {
        $this->pemiluRepositories = $pemiluRepositories;
        $this->pemilihRepositories = $pemilihRepositories;
    }

    public function index()
    {
        $pemilu = Pemilu::with('pemilih')->where('status', 'ACTIVE')->where('end_date', '>', Carbon::now())->get();
        $endDate = Carbon::parse(Pemilu::latest('id')->first()->end_date)->format('M j, Y h:i:s');

        return view('admin.admin', compact('pemilu', 'endDate'));
    }

    public function latestPemilu($pemiluID)
    {
        $pemilu = Pemilu::find(Crypt::decrypt($pemiluID));
        if (!$pemilu) {
            return redirect('/admin')->with('status', 'Pemilu tidak ditemukan');
        }
        $result = Pemilu::with(['dapil.parlement.votes', 'president.votes', 'dapil.pemilih' => function ($e) {
            $e->where('status', 'voted');
        }])->latest('id')->first();
        $president = array();
        $count = array();
        foreach ($result->president as $value) {
            array_push($count, $value->votes->count());
            array_push($president, $value->name);
        }
        return view('admin.latest-pemilu', compact('pemilu', 'president', 'count', 'result'));
    }

    public function showAllPemilu()
    {
        $pemilu = $this->pemiluRepositories->getAllData();
        return view('admin.pemilu', compact('pemilu'));
    }

    public function storePemilu(PemiluRequest $request)
    {
        $payload = $request->validated();
        $this->pemiluRepositories->create($payload);
        return redirect('admin/pemilu')->with('status', 'Data pemilu berhasil ditambahkan');
    }

    public function updatePemilu(PemiluRequest $request, $pemiluID)
    {
        try {
            $payload = $request->validated();
            $this->pemiluRepositories->update($payload, $pemiluID);
            return redirect('admin/pemilu')->with('status', 'Data pemilu berhasil diupdate');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function updateStatusPemilu(Request $request, $pemiluID)
    {
        try {
            $update = $this->pemiluRepositories->statusAndDelete($pemiluID, $request->_method);
            return redirect('admin/pemilu')->with('status', 'Status pemilu berhasil diupdate');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function deletePemilu(Request $request, $pemiluID)
    {
        try {
            $delete = $this->pemiluRepositories->statusAndDelete($pemiluID, $request->_method);
            if (!$delete) {
                return redirect()->back()->withErrors('Tidak Dapat Update Pengguna Sudah Memilih');
            }
            return redirect('admin/pemilu')->with('status', 'Data pemilu berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function showAllKetua()
    {
        $pemilu = Pemilu::where('status', 'ACTIVE')->get();
        $osis = Osis::all();
        return view('admin.calon', compact('osis', 'pemilu'));
    }

    public function storeKetua(KetuaRequest $request)
    {
        $payload = $request->validated();
        $pemilu = Pemilu::find(request('pemilu_id'));
        if (!$pemilu) {
            return redirect('admin/calon')->with('status', 'Data pemilu tidak ditemukan');
        }
        if (request()->hasFile('photo')) {
            $photo = time() . "_" . request()->photo->getClientOriginalName();
            request()->photo->move(public_path('data_calon/' . $pemilu->name . '/' . request('name') . '/photo'), $photo);
        }
        $payload['photo'] = $photo;
        Osis::create($payload);
        return redirect('admin/calon')->with('status', 'Data calon ketua berhasil ditambahkan');
    }

    public function updateKetua(KetuaRequest $request, $osisID)
    {
        $osis = Osis::find($osisID);
        if (!$osis) {
            return redirect('admin/calon')->with('status', 'Data ketua tidak ditemukan');
        }
        $payload = $request->validated();
        $pemilu = Pemilu::find(request('pemilu_id'));
        if (!$pemilu) {
            return redirect('admin/calon')->with('status', 'Data pemilu tidak ditemukan');
        }
        if (request()->hasFile('photo')) {
            $photo = time() . "_" . request()->photo->getClientOriginalName();
            request()->photo->move(public_path('data_calon/' . $pemilu->name . '/' . request('name') . '/photo'), $photo);
            File::delete('data_calon/' . $osis->pemilu->name . '/' . $osis->name . '/photo/' . $osis->photo);
        }
        $payload['photo'] = $photo;
        $osis->update($payload);
        return redirect('admin/calon')->with('status', 'Data calon ketua berhasil diupdate');
    }

    public function deleteKetua($osisID)
    {
        $osis = Osis::find($osisID);
        if (!$osis) {
            return redirect('admin/calon')->with('status', 'Data ketua tidak ditemukan');
        }
        File::delete('data_calon/' . $osis->pemilu->name . '/' . $osis->name . '/photo/' . $osis->photo);
        Osis::destroy($osisID);
        return redirect('admin/calon')->with('status', 'Data calon ketua berhasil dihapus');
    }

    public function showPemilih($pemiluID)
    {
        $data = $this->pemilihRepositories->show(Crypt::decrypt($pemiluID));
        return view('admin.pemilih', compact('data', 'pemiluID'));
    }

    public function printUsers($pemiluID){
        $data = Pemilu::with('pemilih.dapil')->findOrFail($pemiluID);

        $pdf = PDF::loadView('admin.pdf.pemilih', [
            'data' => $data,
            'date' => Carbon::now()
        ]);

        $pdf->setOption('enable-local-file-access', true);

        return $pdf->stream();
    }

    public function storePemilih(PemilihRequest $request, $pemiluID)
    {
        $data = $request->validated();
        $store = $this->pemilihRepositories->store($data, Crypt::decrypt($pemiluID));
        if (!$store) {
            return redirect()->back()->withErrors($store);
        }
        return redirect()->back()->with('status', 'Data pemilih berhasil dibuat');
    }

    public function deletePemilih($pemilihID)
    {
        $delete = $this->pemilihRepositories->delete(Crypt::decrypt($pemilihID));
        if (!$delete) {
            return redirect()->back()->withErrors($delete);
        }
        return redirect()->back()->with('status', 'Data pemilih berhasil dihapus');
    }

    public function hasilPemilu($pemiluID)
    {
        $pemilu = Pemilu::withCount('dapil')->with('dapil', 'president.votes')->findOrFail(Crypt::decrypt($pemiluID));
        $col = 12/($pemilu->dapil_count);
        return view('admin.hasil', compact('pemilu', 'col'));
    }

    public function hasilPemiluDapil($dapilId){
        $dapil = DapilModel::with('parlement.votes', 'pemilih')->findOrFail(Crypt::decrypt($dapilId));
        $all = DapilModel::all();
        $col = 12/($all->count() - 1);
        return view('admin.hasil-parlement', compact('dapil', 'all', 'col'));
    }
}

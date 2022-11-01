<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Osis;
use App\Models\User;
use App\Models\Pemilu;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\KetuaRequest;
use App\Http\Requests\PemiluRequest;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PemilihRequest;
use Illuminate\Support\Facades\Crypt;
use App\Repositories\PemiluRepositories;
use App\Repositories\PemilihRepositories;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $pemiluRepositories;
    protected $pemilihRepositories;

    public function __construct(PemiluRepositories $pemiluRepositories, PemilihRepositories $pemilihRepositories)
    {
        $this->pemiluRepositories = $pemiluRepositories;
        $this->pemilihRepositories = $pemilihRepositories;
    }

    public function generate_password()
    {
        list($usec, $sec) = explode(" ", microtime());
        $microtime = $sec . $usec;
        $microtime = str_replace(array(',', '.'), array('', ''), $microtime);
        $microtime = substr_replace($microtime, rand(10000, 99999), -2);
        $password = substr($microtime, 0, 6) . Str::random(5);
        return $password;
    }

    public function generateUuid()
    {
        $uuid = Str::uuid()->toString();
        $pass = str_replace('-', '', $uuid);
        return $pass;
    }

    public function index()
    {
        return view('admin.admin');
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
        try{
            $payload = $request->validated();
            $update = $this->pemiluRepositories->update($payload, $pemiluID);
            if(!$update){
                return redirect('admin/pemilu')->withErrors("Tidak Dapat Update Pengguna Sudah Memilih");
            }
            return redirect('admin/pemilu')->with('status', 'Data pemilu berhasil diupdate');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function updateStatusPemilu(Request $request, $pemiluID)
    {
        try{
            $update = $this->pemiluRepositories->statusAndDelete($pemiluID, $request->_method);
            if(!$update){
                return redirect()->back()->withErrors('Tidak Dapat Update Pengguna Sudah Memilih');
            }
            return redirect('admin/pemilu')->with('status', 'Status pemilu berhasil diupdate');
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function deletePemilu(Request $request,$pemiluID)
    {
        try{
            $delete = $this->pemiluRepositories->statusAndDelete($pemiluID, $request->_method);
            if(!$delete){
                return redirect()->back()->withErrors('Tidak Dapat Update Pengguna Sudah Memilih');
            }
            return redirect('admin/pemilu')->with('status', 'Data pemilu berhasil dihapus');
        }catch(Exception $e){
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
        $pemilih = $this->pemilihRepositories->show(Crypt::decrypt($pemiluID));
        return view('admin.pemilih', compact('pemilih', 'pemiluID'));
    }

    public function storePemilih(PemilihRequest $request, $pemiluID)
    {
        $data = $request->validated();
        $store = $this->pemilihRepositories->store($data['jumlah'], Crypt::decrypt($pemiluID), $this->generateUuid());
        if(!$store){
            return redirect()->back()->withErrors($store);
        }
        return redirect()->back()->with('status', 'Data pemilih berhasil dibuat');
    }

    public function deletePemilih($pemiluID, $pemilihID)
    {
        $delete = $this->pemilihRepositories->delete(Crypt::decrypt($pemiluID), Crypt::decrypt($pemilihID));
        if(!$delete){
            return redirect()->back()->withErrors($delete);
        }
        return redirect()->back()->with('status', 'Data pemilih berhasil dihapus');
    }

    public function hasilPemilu($pemiluID)
    {
        $pemilu = Pemilu::find($pemiluID);
        if (!$pemilu) {
            return redirect('admin/pemilu')->with('status', 'Data pemilu tidak ditemukan');
        }
        $users = Osis::where('pemilu_id', $pemiluID)->get();
        $jumlah = array();
        foreach ($users as $u) {
            $jumlah[] = $u->pemilih_osis()->count();
        }
        return view('admin.hasil', compact('users', 'jumlah'));
    }
}

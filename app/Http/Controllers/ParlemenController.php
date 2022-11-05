<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\DapilModel;
use App\Models\ParlementModel;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ParlemenRequest;
use App\Repositories\FileRepositories;

class ParlemenController extends Controller
{
    protected $fileRepositories;
    public function __construct(FileRepositories $fileRepositories)
    {
        $this->fileRepositories = $fileRepositories;
    }

    public function index($id){
        $data = DapilModel::with('parlement')->findOrFail(Crypt::decrypt($id));
        return view('admin.parlement.index', compact('data'));
        return $data;
    }

    public function create($pemilu_id){
        $pemilu_id = Crypt::decrypt($pemilu_id);
        return view('admin.parlement.create', compact('pemilu_id'));
    }

    public function store(ParlemenRequest $request, $dapil_id){
        $request->validated();
        try{
            $store_file = $this->fileRepositories->storeFile($request->file('photo'), 'data_parlement');
            $insert = DapilModel::findOrFail(Crypt::decrypt($dapil_id));
            $insert->parlement()->create([
                'name' => $request->name,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'photo' => $store_file
            ]);
            return redirect('admin/parlement/'.$dapil_id.'/show')->with('status', "Calon Legislatif Berhasil");
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function editView($id){
        $data = ParlementModel::findOrFail(Crypt::decrypt($id));
        $dapil = DapilModel::all();
        return view('admin.parlement.edit', compact('data', 'dapil'));
    }

    public function update(ParlemenRequest $request, $id_parlement){
        $request->validated();

        $data = ParlementModel::with('dapil', 'dapil.pemilu')->findOrFail(Crypt::decrypt($id_parlement));

        if(Carbon::now()->gte($data->dapil->pemilu->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Edit, Caleg Pemilu Sudah Dimulai");
        }

        $file = $data->photo;
        if($request->hasFile('photo')){
            $file = $this->fileRepositories->updateFile($request->file('photo'), $data->photo, 'data_parlement');
        }

        $data->update([
            'dapil_id' => $request->dapil_id,
            'name' => $request->name,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'photo' => $file
        ]);

        return redirect('admin/parlement/'.Crypt::encrypt($data->dapil->id).'/show')->with('status', "Calon Legislatif Berhasil Update");
    }

    public function delete($id){
        $data = ParlementModel::with('dapil.pemilu')->findOrFail(Crypt::decrypt($id));

        if(Carbon::now()->gte($data->dapil->pemilu->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Menghapus, Caleg Pemilu Sudah Dimulai");
        }

        try{
            $this->fileRepositories->unlink($data->photo);
            $data->delete();
            return redirect()->back()->with('status', "Caleg Deleted Succesfully");
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

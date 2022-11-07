<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ParlemenRequest;
use App\Models\PresidentModel;
use App\Repositories\FileRepositories;

class PresidentController extends Controller
{
    protected $fileRepositories;
    public function __construct(FileRepositories $fileRepositories)
    {
        $this->fileRepositories =  $fileRepositories;
    }

    public function listPemilu(){
        $data = Pemilu::withCount('president')->where('status', 'ACTIVE')->get();
        return view('admin.president.index', compact('data'));
    }

    public function listPresident($id){
        $data = Pemilu::with('president')->findOrFail(Crypt::decrypt($id));
        return view('admin.president.listPresident', compact('data'));
    }

    public function create($id){
        return view('admin.president.create', compact('id'));
    }

    public function store(ParlemenRequest $request, $id){
        $request->validated();

        $data = Pemilu::findOrFail(Crypt::decrypt($id));

        if(Carbon::now()->gte($data->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Menambahkan Calon President, Pemilu Sudah Dimulai");
        }

        $store_file = $this->fileRepositories->storeFile($request->file('photo'), 'data_president');

        $data->president()->create([
            'name' => $request->name,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'photo' => $store_file
        ]);

        return redirect()->back()->with('status', 'Data Calon President Berhasil Ditambahkan');
    }

    public function edit($id){
        $data = PresidentModel::with('pemilu')->findOrFail(Crypt::decrypt($id));
        $pemilu = Pemilu::where('status', 'ACTIVE')->get();

        if(Carbon::now()->gte($data->pemilu->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Edit Calon President, Pemilu Sudah Dimulai");
        }

        return view('admin.president.edit', compact('data', 'pemilu', 'id'));
    }

    public function update(ParlemenRequest $request, $id){
        $request->validated();

        $data = PresidentModel::with('pemilu')->findOrFail(Crypt::decrypt($id));

        if(Carbon::now()->gte($data->pemilu->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Edit Calon President, Pemilu Sudah Dimulai");
        }

        $file = $data->photo;
        if($request->hasFile('photo')){
            $file = $this->fileRepositories->updateFile($request->file('photo'), $data->photo, 'data_president');
        }

        $data->update([
            'pemilu_id' => $request->pemilu_id,
            'name' => $request->name,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'photo' => $file
        ]);

        return redirect('admin/president/'.Crypt::encrypt($data->pemilu->id).'/list');
    }

    public function delete($id){
        $data = PresidentModel::with('pemilu')->findOrFail(Crypt::decrypt($id));

        if(Carbon::now()->gte($data->pemilu->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Edit Calon President, Pemilu Sudah Dimulai");
        }

        $this->fileRepositories->unlink($data->photo);

        $data->delete();

        return redirect()->back()->with('status', "President Deleted Succesfully");
    }
}

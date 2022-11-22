<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemilu;
use App\Models\DapilModel;
use Illuminate\Http\Request;
use App\Http\Requests\DapilRequest;
use Illuminate\Support\Facades\Crypt;

class DapilController extends Controller
{
    public function index(){
        $data = DapilModel::with('pemilu')->get();
        $pemilu = Pemilu::where('status', 'ACTIVE')->get();
        return view('admin.dapil', compact('data', 'pemilu'));
    }

    public function create(DapilRequest $request){
        $request->validated();

        $data = Pemilu::find($request->pemilu_id);

        if(Carbon::now()->gte($data->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Menambahkan Dapil Pemilu Sudah Dimulai");
        }

        $data->dapil()->create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', "Dapil Berhasil Dibuat");
    }

    public function update(DapilRequest $request, $id){
        $request->validated();

        $data = DapilModel::with('pemilu')->findOrFail(Crypt::decrypt($id));

        if(Carbon::now()->gte($data->pemilu->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Update Dapil, Pemilu Sudah Dimulai");
        }

        $data->update([
            'name' => $request->name,
            'pemilu_id' => $request->pemilu_id
        ]);

        return redirect()->back()->with('status', "Dapil Berhasil Diupdate");
    }

    public function delete($id){
        $data = DapilModel::with('pemilu')->findOrFail(Crypt::decrypt($id));

        if(Carbon::now()->gte($data->pemilu->start_date)){
            return redirect()->back()->withErrors("Tidak Dapat Update Dapil, Pemilu Sudah Dimulai");
        }

        $data->delete();

        return redirect()->back()->with('status', "Dapil Berhasil Dihapus");
    }
}

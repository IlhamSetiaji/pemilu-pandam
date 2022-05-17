<?php

namespace App\Http\Controllers;

use App\Models\Osis;
use Illuminate\Http\Request;

class PemilihController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $data = Osis::where('pemilu_id',$user->pemilu_id)->get();
        return view('pemilih.pemilih',compact('data','user'));
    }

    public function pilihKetua($userID)
    {
        $user = request()->user();
        if($user->status == 'SUDAH')
        {
            return redirect('/')->with('status','Hak pilih anda sudah habis');
        }
        $user->pemilih_osis()->attach($userID);
        $user->update(['status' => 'SUDAH']);
        return redirect('/')->with('status','Berhasil memilih salah satu calon ketua');
    }
}

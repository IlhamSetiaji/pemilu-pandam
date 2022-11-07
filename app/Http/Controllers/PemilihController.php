<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Models\Osis;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PemilihController extends Controller
{
    public function index()
    {
        $data = User::with('profile.pemilu.president', 'profile.dapil.parlement')->findOrFail(Auth::user()->id);
        return view('pemilih.pemilih',compact('data'));
    }

    public function vote($id, VoteRequest $request){
        $request->validated();

        $vote = User::with('profile.pemilu')->findOrFail(Crypt::decrypt($id));

        DB::beginTransaction();
        try{
            $vote->profile->vote()->create([
                'pemilu_id' => $vote->profile->pemilu->id,
                'parlement_id' => $request->parlement,
                'president_id' => $request->president,
            ]);
            $vote->profile()->update([
                'status' => 'voted'
            ]);
            DB::commit();
            return redirect()->back()->with('status', 'Suara Berhasil Disimpan Silahkan Logout');
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
}

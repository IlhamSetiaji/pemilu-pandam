<?php
namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Models\Pemilu;
use Illuminate\Support\Facades\DB;

class PemilihRepositories{
    public function show($pemiluId){
        $data = User::where('pemilu_id', $pemiluId)->whereHas('roles', function ($query) {
            $query->where('name', '=', 'pemilih');
        })->get();

        return $data;
    }

    public function store($jumlah, $pemiluID, $password){
        DB::beginTransaction();
        try{
            for ($i = 0; $i < $jumlah; $i++) {
                $user = User::create([
                    'pemilu_id' => $pemiluID,
                    'password' => $password,
                ]);
                $user->assignRole('pemilih');
            }
            DB::commit();
            return true;
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function delete($pemiluId, $pemilihId){
        try{
            $pemilu = Pemilu::findOrFail($pemiluId);
            $pemilu->users()->findOrFail($pemilihId)->delete();
            return true;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
?>

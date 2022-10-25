<?php
namespace App\Repositories;

use App\Models\Pemilu;

    class PemiluRepositories{
        public function getAllData(){
            $data = Pemilu::all();
            return $data;
        }

        public function create($request){
            Pemilu::create($request);
        }

        public function update($request, $pemiluId){
            $pemilu = Pemilu::with(['users' => function($query){
                $query->whereHas('pemilih_osis')->where('status', 'SUDAH');
            }])->findOrFail($pemiluId);

            if($pemilu->users_count > 1){
                return false;
            }

            $pemilu->update($request);
        }

        public function statusAndDelete($pemiluId, $request){
            $data = Pemilu::with(['users' => function($query){
                $query->whereHas('pemilih_osis')->where('status', 'SUDAH');
            }])->findOrFail($pemiluId);

            if($request == 'PUT' && $data->users_count < 1){
                $data->status == 'ACTIVE' ? $status = 'INACTIVE' : $status = 'ACTIVE';
                $data->update(['status' => $status]);
            }elseif($request == 'DELETE' && $data->users_count < 1){
                $data->delete();
            }else{
                return false;
            }

            return true;
        }
    }
?>

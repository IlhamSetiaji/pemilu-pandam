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
            $pemilu = Pemilu::findOrFail($pemiluId);

            $pemilu->update($request);
        }

        public function statusAndDelete($pemiluId, $request){
            $data = Pemilu::findOrFail($pemiluId);

            if($request == 'PUT'){
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

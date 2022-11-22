<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Models\Pemilu;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PemilihRepositories
{
    public function show($pemiluId)
    {
        $data = Pemilu::with('pemilih.user', 'pemilih.dapil', 'dapil')->findOrFail($pemiluId);
        return $data;
    }

    public function store($data, $pemiluID)
    {
        DB::beginTransaction();
        try {
            for ($i = 0; $i < $data['jumlah']; $i++) {
                $user = User::create([
                    'pemilu_id' => $pemiluID,
                    'password' => "D".$data['dapil']."P".$pemiluID.Str::random(3).Carbon::now()->format('H').Carbon::now()->format('s'),
                ]);
                $user->profile()->create([
                    'pemilu_id' => $pemiluID,
                    'dapil_id' => $data['dapil']
                ]);
                $user->assignRole('pemilih');
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function delete($pemilihId)
    {
        try {
            User::findOrFail($pemilihId)->delete();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function generateUuid()
    {
        $uuid = Str::uuid()->toString();
        $pass = str_replace('-', '', $uuid);
        return $pass;
    }
}

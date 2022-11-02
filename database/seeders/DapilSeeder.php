<?php

namespace Database\Seeders;

use App\Models\DapilModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DapilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'pemilu_id' => 1,
                'name' => 'Dapil I',
            ],
            [
                'pemilu_id' => 1,
                'name' => 'Dapil II',
            ],
            [
                'pemilu_id' => 1,
                'name' => 'Dapil III',
            ],
        ];

        foreach($data as $dapil){
            DapilModel::create($dapil);
        }
    }
}

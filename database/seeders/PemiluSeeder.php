<?php

namespace Database\Seeders;

use App\Models\Pemilu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemiluSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Pemilu 1',
                'start_date' => Carbon::now(),
                'end_date' => '2022-06-30 23:59:00',
            ],
        ])->each(function($pemilu){
            Pemilu::create($pemilu);
        });
    }
}

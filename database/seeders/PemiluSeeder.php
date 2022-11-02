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
                'name' => 'Pemilu Sekolah Vokasi UNS',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(2),
            ],
        ])->each(function($pemilu){
            Pemilu::create($pemilu);
        });
    }
}

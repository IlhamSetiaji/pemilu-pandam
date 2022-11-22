<?php

namespace Database\Seeders;

use App\Models\PresidentModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresidentSeeder extends Seeder
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
                'name' => 'Ridho Sukmadipraja',
                'visi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'misi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'photo' => '407UR-Osaka-Shizuku-I-Wanted-to-Say-This-through-Chocolate-Sweet-Choco-OTrRHH.png'
            ],
            [
                'pemilu_id' => 1,
                'name' => 'Satria Adhi Nugraha',
                'visi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'misi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'photo' => '407UR-Osaka-Shizuku-I-Wanted-to-Say-This-through-Chocolate-Sweet-Choco-bPCAiR.png'
            ],
        ];

        foreach ($data as $president) {
            PresidentModel::create($president);
        }
    }
}

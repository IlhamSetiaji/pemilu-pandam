<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'Admin',
                'password' => 'password',
            ],
            // [
            //     'name' => 'Pemilih',
            //     'password' => 'password',
            //     'pemilu_id' => 1,
            // ],
        ])->each(function($users){
            $user = \App\Models\User::create($users);
            $user->id == 1 ? $user->assignRole('admin') : '';
            // $user->id == 2 ? $user->assignRole('pemilih') : '';
        });
    }
}

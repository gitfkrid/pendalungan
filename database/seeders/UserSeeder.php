<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
        [
            'uuid' => 'b7ccb5bd-1218-4ac7-9757-62213aeaf853',
            'name' => 'Admin Pendalungan',
            'email' => 'cvpendalunganmegahsolusi@gmail.com',
            'hp' => '6281234567890',
            'alamat' => 'Jl. Semeru, Mastrip',
            'email_verified_at' => now(),
            'id_level' => '1',
            'password' => bcrypt('BK^uWCrhqh2J%V*h'),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'uuid' => '6cd04842-c0b7-46ee-97c8-d26ccf279118',
            'name' => 'Novananda',
            'email' => 'novananda@gmail.com',
            'hp' => '6281234567890',
            'alamat' => 'Jl. Semeru, Mastrip',
            'email_verified_at' => now(),
            'id_level' => '2',
            'password' => bcrypt('Novananda.fCm.rW7x'),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'uuid' => 'e42f304c-b84e-4f22-87d9-013baec94a0c',
            'name' => 'Fikri Ahdiar',
            'email' => 'email.fkrid@gmail.com',
            'hp' => '6289505016100',
            'alamat' => 'Jl. MH. Thamrin, Gladak Pakem',
            'email_verified_at' => now(),
            'id_level' => '3',
            'password' => bcrypt('Fikri1234@#'),
            'created_at' => now(),
            'updated_at' => now(),
        ]
        ));
    }
}

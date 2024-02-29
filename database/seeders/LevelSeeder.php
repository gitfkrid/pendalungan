<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level')->insert(array(
            [
                'nama_level' => 'Super Admin'
            ],
            [
                'nama_level' => 'Admin'
            ],
            [
                'nama_level' => 'Staff'
            ],
            [
                'nama_level' => 'Pelanggan'
            ]
        ));
    }
}

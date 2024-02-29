<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_sewa')->insert(array(
            [
                'nama_status_sewa' => 'Menunggu'
            ],
            [
                'nama_status_sewa' => 'Berlangsung'
            ],
            [
                'nama_status_sewa' => 'Selesai'
            ],
            [
                'nama_status_sewa' => 'Gagal'
            ]
        ));
    }
}

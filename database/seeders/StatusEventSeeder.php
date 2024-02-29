<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_event')->insert(array(
            [
                'nama_status_event' => 'DP'
            ],
            [
                'nama_status_event' => 'Berlangsung'
            ],
            [
                'nama_status_event' => 'Selesai'
            ],
            [
                'nama_status_event' => 'Gagal'
            ]
        ));
    }
}

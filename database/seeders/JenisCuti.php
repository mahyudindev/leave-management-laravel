<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class JenisCuti extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_cuti')->insert([
            'nama_cuti' => 'Cuti Tahunan',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

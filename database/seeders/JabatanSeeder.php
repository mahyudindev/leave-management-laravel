<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('jabatan')->insert([
            'nama' => 'Manager',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('jabatan')->insert([
            'nama' => 'STAF',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

}

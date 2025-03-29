<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['nama' => 'Human Resources', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Finance', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Information Technology', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Marketing', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Operations', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sales', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('departemen')->insert($departments);
    }
}

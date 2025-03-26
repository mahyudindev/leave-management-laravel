<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create departments and positions first
        $this->call([
            UserSeeder::class,
            // DepartmentSeeder::class,
            // PositionSeeder::class
        ]);
    }
}

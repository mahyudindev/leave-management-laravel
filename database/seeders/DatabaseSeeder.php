<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create departments and positions first
        $this->call([
            DepartemenSeeder::class,
            UserSeeder::class,
            JabatanSeeder::class,
            JenisCuti::class,
        ]);
    }
}

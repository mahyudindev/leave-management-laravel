<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'nik' => '1234567890', // Pastikan diisi
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'tanggal_masuk' => '2023-01-01',
                'departemen' => null,
                'jabatan' => null,
                'jumlah_cuti' => 12,
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => '9876543210', // Pastikan diisi
                'name' => 'Regular User',
                'email' => 'user@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'tanggal_masuk' => '2023-01-01',
                'departemen' => null,
                'jabatan' => null,
                'jumlah_cuti' => 10,
                'role' => 'user',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nik' => '1122334455', // Pastikan diisi
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123'),
                'tanggal_masuk' => '2023-01-01',
                'departemen' => null,
                'jabatan' => null,
                'jumlah_cuti' => 15,
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}



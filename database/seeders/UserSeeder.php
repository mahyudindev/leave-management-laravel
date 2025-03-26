<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        // HRD
        DB::table('users')->insert([
            'nik' => '1234567890',
            'name' => 'HRD Manager',
            'email' => 'hrd@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123'),
            'tanggal_masuk_kerja' => '2023-01-01',
            'departemen_id' => null,
            'jabatan_id' => null,
            'jumlah_cuti' => '12',
            'role' => 'hrd',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Manager (IT)
        DB::table('users')->insert([
            'nik' => '9876543210',
            'name' => 'IT Manager',
            'email' => 'manager@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123'),
            'tanggal_masuk_kerja' => '2023-01-01',
            'departemen_id' => null,
            'jabatan_id' => null,
            'jumlah_cuti' => '10',
            'role' => 'manager',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Pegawai (IT)
        DB::table('users')->insert([
            'nik' => '1122334455',
            'name' => 'John Doe',
            'email' => 'pegawai@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123'),
            'tanggal_masuk_kerja' => '2023-01-01',
            'departemen_id' => null,
            'jabatan_id' => null,
            'jumlah_cuti' => '10',
            'role' => 'pegawai',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Generate 10 additional employees
        // $faker = Faker::create('id_ID');
        // for ($i = 1; $i <= 10; $i++) {
        //     DB::table('users')->insert([
        //         'nik' => $faker->unique()->numberBetween(1000000000, 9999999999),
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail,
        //         'email_verified_at' => Carbon::now(),
        //         'password' => Hash::make('password123'),
        //         'tanggal_masuk_kerja' => $faker->date('Y-m-d', 'now'),
        //         'departemen_id' => null,
        //         'jabatan_id' => null,
        //         'jumlah_cuti' => '10',
        //         'role' => 'pegawai',
        //         'remember_token' => Str::random(10),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
    }
}

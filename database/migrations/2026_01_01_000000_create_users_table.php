<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nik', 10)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('tanggal_masuk');
            $table->string('jumlah_cuti', 10);
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->rememberToken();
            $table->timestamps();

            // Foreign keys yang nullable
            $table->string('departemen', 10)->nullable(); // Foreign key ke tabel departemen, boleh NULL
            $table->string('jabatan', 10)->nullable();   // Foreign key ke tabel jabatan, boleh NULL

            $table->foreign('departemen')->references('id_dept')->on('departemen')->onDelete('cascade');
            $table->foreign('jabatan')->references('id_jabatan')->on('jabatan')->onDelete('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};





































// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     public function up(): void
//     {
//         Schema::create('users', function (Blueprint $table) {
//             $table->id();
//             $table->string('nik', 10)->unique();
//             $table->string('name');
//             $table->string('email')->unique();
//             $table->timestamp('email_verified_at')->nullable();
//             $table->string('password');
//             $table->date('tanggal_masuk');
//             $table->string('departemen', 50);
//             $table->string('jabatan', 50);
//             $table->string('jumlah_cuti', 10);
//             $table->enum('role', ['admin', 'user', 'superadmin']);
//             $table->rememberToken();
//             $table->timestamps();
//         });

//         Schema::create('password_reset_tokens', function (Blueprint $table) {
//             $table->string('email')->primary();
//             $table->string('token');
//             $table->timestamp('created_at')->nullable();
//         });

//         Schema::create('sessions', function (Blueprint $table) {
//             $table->string('id')->primary();
//             $table->foreignId('user_id')->nullable()->index();
//             $table->string('ip_address', 45)->nullable();
//             $table->text('user_agent')->nullable();
//             $table->longText('payload');
//             $table->integer('last_activity')->index();
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('users');
//         Schema::dropIfExists('password_reset_tokens');
//         Schema::dropIfExists('sessions');
//     }
// };

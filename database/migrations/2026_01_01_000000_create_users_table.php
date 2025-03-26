<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 10)->unique();
            $table->string('name', 30);
            $table->string('email', 30)->unique();
            $table->string('password',70);
            $table->date('tanggal_masuk_kerja')->nullable();
            $table->date('tanggal_akhir_kerja')->nullable();
            $table->string('jumlah_cuti', 2);
            $table->enum('role', ['hrd','manager', 'pegawai'])->default('pegawai');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

            // Add foreign key constraints after all columns
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatan', 'id');
            $table->foreignId('departemen_id')->nullable()->constrained('departemen', 'id');
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

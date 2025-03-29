<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('jenis_cuti_id')->constrained('jenis_cuti')->onDelete('cascade');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('jumlah');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->enum('status_manager', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->enum('status_hrd', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->text('notes_manager')->nullable();
            $table->text('notes_hrd')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};

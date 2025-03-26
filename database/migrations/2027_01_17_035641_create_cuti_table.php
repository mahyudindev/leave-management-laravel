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
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('jumlah');
            $table->foreignId('jenis_cuti')->constrained('jenis_cuti')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved_manager', 'rejected_manager', 'approved_hrd', 'rejected_hrd'])->default('pending');
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

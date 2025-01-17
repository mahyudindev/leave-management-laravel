<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->string('kode', 10)->primary();
            $table->unsignedBigInteger('id_user'); // Foreign key ke users.id
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('jumlah');
            $table->string('jenis_cuti', 50);
            $table->string('ket', 50);
            $table->enum('status', ['Approved', 'Rejected', 'Pending']);
            $table->timestamps();

            // Foreign key
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};


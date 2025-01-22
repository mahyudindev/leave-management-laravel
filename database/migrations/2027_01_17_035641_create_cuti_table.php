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
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('jumlah');
            $table->unsignedBigInteger('jenis_cuti');
            $table->string('ket', 50);
            $table->enum('status', ['Approved', 'Rejected', 'Pending']);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('jenis_cuti')->references('id')->on('jenis_cuti')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};


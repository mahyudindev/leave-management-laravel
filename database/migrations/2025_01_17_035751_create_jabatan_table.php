<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->string('id_jabatan', 10)->primary();
            $table->string('jabatan', 50);
            $table->integer('tunjangan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};;

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departemen', function (Blueprint $table) {
            $table->string('id_dept', 10)->primary();
            $table->string('nama_dept', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departemen');
    }
};


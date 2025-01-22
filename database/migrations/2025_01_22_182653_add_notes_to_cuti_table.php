<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesToCutiTable extends Migration
{
    public function up()
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('cuti', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
}

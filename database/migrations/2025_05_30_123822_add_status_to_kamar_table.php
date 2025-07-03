<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToKamarTable extends Migration
{
    public function up()
    {
        Schema::table('kamar', function (Blueprint $table) {
            $table->enum('status', ['tersedia', 'tidak_tersedia'])->default('tersedia');
        });
    }

    public function down()
    {
        Schema::table('kamar', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

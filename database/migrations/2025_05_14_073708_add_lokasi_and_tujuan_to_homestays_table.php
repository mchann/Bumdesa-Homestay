<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('homestays', function (Blueprint $table) {
        $table->string('lokasi')->nullable(); // Kolom lokasi
        $table->string('tujuan')->nullable(); // Kolom tujuan
    });
}

public function down()
{
    Schema::table('homestays', function (Blueprint $table) {
        $table->dropColumn('lokasi');
        $table->dropColumn('tujuan');
    });
}

};

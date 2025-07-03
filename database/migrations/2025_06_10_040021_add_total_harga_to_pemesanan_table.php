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
    Schema::table('pemesanan', function (Blueprint $table) {
        $table->integer('total_harga')->after('catatan')->default(0);
    });
}

public function down()
{
    Schema::table('pemesanan', function (Blueprint $table) {
        $table->dropColumn('total_harga');
    });
}
};

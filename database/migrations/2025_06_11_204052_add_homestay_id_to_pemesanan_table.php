<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHomestayIdToPemesananTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
           
            $table->unsignedBigInteger('homestay_id')->after('pelanggan_id');

           
            $table->foreign('homestay_id')
                  ->references('homestay_id')
                  ->on('homestays')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
        
            $table->dropForeign(['homestay_id']);
            $table->dropColumn('homestay_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::table('kamar', function (Blueprint $table) {
        $table->unsignedBigInteger('jenis_kamar_id')->after('homestay_id');

        $table->foreign('jenis_kamar_id')
              ->references('jenis_kamar_id')
              ->on('jenis_kamar')
              ->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('kamar', function (Blueprint $table) {
        $table->dropForeign(['jenis_kamar_id']);
        $table->dropColumn('jenis_kamar_id');
    });
}
};

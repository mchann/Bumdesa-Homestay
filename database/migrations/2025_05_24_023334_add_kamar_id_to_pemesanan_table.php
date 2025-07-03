<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
{
    Schema::table('pemesanan', function (Blueprint $table) {
       $table->unsignedBigInteger('kamar_id');
        $table->foreign('kamar_id')->references('kamar_id')->on('kamar')->onDelete('cascade');

    });
}


    public function down(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropForeign(['kamar_id']);
            $table->dropColumn('kamar_id');
        });
    }
};


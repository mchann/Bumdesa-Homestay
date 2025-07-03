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
        Schema::create('lokasi_sekitar', function (Blueprint $table) {
    $table->id('lokasi_id');
    $table->unsignedBigInteger('homestay_id');
    $table->string('nama_tempat');
    $table->string('jarak');
    $table->string('icon')->default('bi-geo-alt'); // Default Bootstrap icon
    $table->timestamps();

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
        Schema::dropIfExists('lokasi_sekitars');
    }
};

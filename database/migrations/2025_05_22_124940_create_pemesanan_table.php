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
    Schema::create('pemesanan', function (Blueprint $table) {
        $table->id('pemesanan_id'); // PRIMARY KEY
        $table->unsignedBigInteger('pelanggan_id'); // FOREIGN KEY
        $table->date('tgl_check_in');
        $table->date('tgl_check_out');
        $table->integer('jumlah_tamu');
        $table->integer('jumlah_kamar');
        $table->text('catatan')->nullable();
        $table->timestamps();

        // Foreign Key Constraint
        $table->foreign('pelanggan_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};

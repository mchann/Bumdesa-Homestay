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
    Schema::create('kamar', function (Blueprint $table) {
        $table->id('kamar_id');
        $table->foreignId('homestay_id')->constrained('homestays', 'homestay_id')->onDelete('cascade');
        $table->string('nama_kamar', 100);
        $table->string('kapasitas', 10);
        $table->decimal('harga', 10, 2);
        $table->string('foto_kamar');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};

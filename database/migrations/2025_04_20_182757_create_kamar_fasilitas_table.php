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
        Schema::create('kamar_fasilitas', function (Blueprint $table) {
            $table->id('kamar_fasilitas_id');
            $table->foreignId('kamar_id')->constrained('kamar', 'kamar_id')->onDelete('cascade');
            $table->foreignId('fasilitas_id')->constrained('fasilitas', 'fasilitas_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_fasilitas');
    }
};

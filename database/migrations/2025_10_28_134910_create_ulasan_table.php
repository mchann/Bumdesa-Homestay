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
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('ulasan_id'); // Primary Key
            
            // Relasi ke tabel pemesanan (sudah benar)
            $table->foreignId('pemesanan_id')
                ->unique()
                ->references('pemesanan_id')->on('pemesanan') 
                ->onDelete('cascade');
                
            // PERBAIKAN: Mengubah referensi dari 'homestay' menjadi 'homestays' (plural)
            $table->foreignId('homestay_id')
                ->references('homestay_id')->on('homestays') // <- SOLUSI
                ->onDelete('cascade');
                
            // Relasi ke tabel users (sudah benar)
            $table->foreignId('pelanggan_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->tinyInteger('rating')->unsigned(); // Rating 1-5
            $table->text('komentar')->nullable();
            $table->text('balasan_admin')->nullable();
            $table->boolean('disembunyikan')->default(false);
            $table->timestamps();

            // Tambahkan index untuk pencarian cepat
            $table->index(['homestay_id', 'disembunyikan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};

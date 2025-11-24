<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Tambahkan kolom 'balasan_pemilik' ke tabel 'ulasan'
        Schema::table('ulasan', function (Blueprint $table) {
            // Kolom balasan_pemilik bertipe text (untuk komentar panjang)
            // Dapat bernilai NULL
            // Ditempatkan setelah kolom 'balasan_admin'
            $table->text('balasan_pemilik')->nullable()->after('balasan_admin');
        });
    }

    /**
     * Batalkan migrasi (Rollback).
     */
    public function down(): void
    {
        // Hapus kolom 'balasan_pemilik' jika migrasi dibatalkan
        Schema::table('ulasan', function (Blueprint $table) {
            $table->dropColumn('balasan_pemilik');
        });
    }
};

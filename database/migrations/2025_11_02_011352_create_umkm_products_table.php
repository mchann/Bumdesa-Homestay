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
        Schema::create('umkm_products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->decimal('harga', 12, 2);
            $table->string('kategori');
            $table->string('gambar')->nullable();
            $table->string('no_telepon_owner'); // Tambahan kolom no telepon owner
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('stok')->default(0);
            $table->decimal('berat', 8, 2)->default(0);
            $table->string('satuan_berat')->default('gr');
            $table->json('tags')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('terjual')->default(0);
            $table->string('badge')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
            
            // Index untuk performa
            $table->index('kategori');
            $table->index('status');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_products');
    }
};
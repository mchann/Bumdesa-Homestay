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
        Schema::create('homestays', function (Blueprint $table) {
            $table->id('homestay_id');
            $table->foreignId('pemilik_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_homestay', 100);
            $table->string('link_google_maps');
            $table->string('alamat_homestay');
            $table->text('deskripsi')->nullable();
            $table->string('peraturan');
            $table->string('foto_homestay');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homestays');
    }
};

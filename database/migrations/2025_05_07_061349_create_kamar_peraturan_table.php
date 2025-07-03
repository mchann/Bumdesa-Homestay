<?php

// database/migrations/xxxx_xx_xx_create_kamar_peraturan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
       
        Schema::create('kamar_peraturan', function (Blueprint $table) {
            $table->id('kamar_peraturan_id');
            $table->foreignId('kamar_id')->constrained('kamar', 'kamar_id')->onDelete('cascade');
            $table->foreignId('peraturan_id')->constrained('peraturan', 'peraturan_id')->onDelete('cascade'); // Perhatikan parameter kedua
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kamar_peraturan');
    }
};


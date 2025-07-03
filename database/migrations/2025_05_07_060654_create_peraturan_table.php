<?php

// database/migrations/xxxx_xx_xx_create_peraturan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('peraturan', function (Blueprint $table) {
            $table->id('peraturan_id');
            $table->string('isi_peraturan');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('peraturan');
    }
};

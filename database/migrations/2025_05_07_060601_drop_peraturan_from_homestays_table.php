<?php

// database/migrations/xxxx_xx_xx_drop_peraturan_from_homestays_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('homestays', function (Blueprint $table) {
            $table->dropColumn('peraturan');
        });
    }

    public function down(): void {
        Schema::table('homestays', function (Blueprint $table) {
            $table->text('peraturan')->nullable(); // restore kalau di-rollback
        });
    }
};


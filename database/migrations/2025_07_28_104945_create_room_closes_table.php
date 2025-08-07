<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('room_closes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kamar_id');
        $table->date('start_date');
        $table->date('end_date');
        $table->timestamps();

        $table->foreign('kamar_id')->references('kamar_id')->on('kamar')->onDelete('cascade');
    });
}



    public function down(): void
    {
        Schema::dropIfExists('room_closes');
    }
};

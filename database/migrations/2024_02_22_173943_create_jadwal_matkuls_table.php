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
        Schema::create('jadwal_matkuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_matakuliah');
            $table->unsignedBigInteger('id_ruang');
            
            $table->foreign('id_matakuliah')->references('id')->on('matakuliahs')->onDelete('cascade');

            
            $table->foreign('id_ruang')->references('id')->on('ruangs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_matkuls');
    }
};

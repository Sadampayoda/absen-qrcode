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
        Schema::create('matakuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            
            $table->enum('kelas',['A','B','C','D','E']);
            $table->enum('sks', [2, 3, 4, 6]);
            $table->enum('semester', [1, 2, 3, 4, 5, 6, 7, 8]);
            $table->integer('prasyarat')->nullable();
            $table->unsignedBigInteger('id_users');
            $table->unsignedInteger('prasyarat_sks')->nullable();
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliahs');
    }
};

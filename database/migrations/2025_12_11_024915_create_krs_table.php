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
        Schema::create('krs', function (Blueprint $table) {
            $table->id();

            // 1. Siapa Mahasiswanya? (Relasi ke users)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // 2. Jadwal Apa yang Diambil? (Relasi ke jadwal_kuliahs)
            $table->foreignId('jadwal_kuliah_id')->constrained('jadwal_kuliahs')->onDelete('cascade');

            $table->timestamps();

            // Mencegah Duplikasi: 
            // Satu mahasiswa tidak boleh ambil jadwal yang sama 2 kali di database
            $table->unique(['user_id', 'jadwal_kuliah_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};

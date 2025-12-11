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
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk')->unique(); // Misal: TI-001
            $table->string('nama_mk'); // Misal: Algoritma Dasar
            $table->integer('sks'); // Misal: 3
            $table->integer('semester_paket')->nullable(); // Biasanya mata kuliah ini diambil di semester berapa (1-8)

            // Relasi ke Prodi (Mata kuliah ini milik prodi apa?)
            // onDelete('cascade') artinya kalau prodi dihapus, mata kuliahnya ikut terhapus
            $table->foreignId('prodi_id')->constrained('prodis')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};

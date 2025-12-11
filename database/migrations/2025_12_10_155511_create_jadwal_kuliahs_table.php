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
        Schema::create('jadwal_kuliahs', function (Blueprint $table) {
            $table->id();

            // 1. Relasi ke Mata Kuliah (Wajib)
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');

            // 2. Relasi ke Dosen (Ambil dari tabel users yang role-nya dosen)
            // Karena tabel aslinya 'users', kita harus spesifik
            $table->foreignId('dosen_id')->constrained('users')->onDelete('cascade');

            // 3. Relasi ke Ruangan (Wajib)
            $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade');

            // 4. Relasi ke Semester (Wajib)
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');

            // 5. Data Waktu
            $table->string('hari'); // Senin, Selasa, dst.
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            // 6. Kapasitas Kelas (Opsional, untuk batas jumlah mahasiswa)
            $table->integer('kuota')->default(30);

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliahs');
    }
};

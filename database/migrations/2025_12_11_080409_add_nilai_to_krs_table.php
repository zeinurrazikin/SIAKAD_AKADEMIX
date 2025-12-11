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
        Schema::table('krs', function (Blueprint $table) {
            // Kita pakai nullable() karena saat awal ambil KRS, nilainya pasti kosong
            $table->decimal('nilai_tugas', 5, 2)->nullable()->default(0);
            $table->decimal('nilai_uts', 5, 2)->nullable()->default(0);
            $table->decimal('nilai_uas', 5, 2)->nullable()->default(0);

            // Nilai Akhir (Gabungan rumus)
            $table->decimal('nilai_akhir', 5, 2)->nullable()->default(0);

            // Nilai Huruf (A, B, C, D, E)
            $table->char('grade', 2)->nullable()->default('-');
        });
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->dropColumn(['nilai_tugas', 'nilai_uts', 'nilai_uas', 'nilai_akhir', 'grade']);
        });
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'krs';

    protected $fillable = [
        'user_id',
        'jadwal_kuliah_id',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_akhir',
        'grade'
    ];

    // RELASI

    // KRS milik Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // KRS terhubung ke Jadwal
    public function jadwal()
    {
        return $this->belongsTo(JadwalKuliah::class, 'jadwal_kuliah_id');
    }
}

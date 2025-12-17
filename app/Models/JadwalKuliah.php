<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'mata_kuliah_id',
        'dosen_id',
        'ruangan_id',
        'semester_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kuota'
    ];

    // Jadwal milik Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    // Jadwal diajar oleh Dosen (User)
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    // Jadwal ada di Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    // Jadwal berlaku di Semester tertentu
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}

<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'semester_paket', 'prodi_id'];

    // Relasi: Mata Kuliah milik satu Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
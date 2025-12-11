<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    // Pastikan ini ada!
    protected $fillable = ['nama_semester', 'aktif'];
}

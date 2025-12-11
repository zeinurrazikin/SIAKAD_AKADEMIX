<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenNilaiController extends Controller
{
    // 1. HALAMAN DAFTAR KELAS
    public function index()
    {
        // Cari jadwal yang dosennya adalah user yang sedang login
        $jadwals = JadwalKuliah::with(['mataKuliah', 'ruangan', 'semester'])
            ->where('dosen_id', Auth::id())
            ->latest()
            ->get();

        return view('dosen.nilai.index', compact('jadwals'));
    }
    // 2. HALAMAN INPUT NILAI (DAFTAR MAHASISWA)
    public function show($id_jadwal)
    {
        // Pastikan jadwal ini benar-benar milik dosen yang login (Security)
        $jadwal = JadwalKuliah::where('id', $id_jadwal)
            ->where('dosen_id', Auth::id())
            ->firstOrFail();

        // Ambil data KRS (Mahasiswa yang ambil jadwal ini)
        // Kita butuh data user (mahasiswanya) untuk ditampilkan namanya
        $listMahasiswa = \App\Models\Krs::with('mahasiswa')
            ->where('jadwal_kuliah_id', $id_jadwal)
            ->get();

        return view('dosen.nilai.show', compact('jadwal', 'listMahasiswa'));
    }

    // 3. PROSES SIMPAN NILAI
    public function update(Request $request, $id_krs)
    {
        // Validasi input angka (0 sampai 100)
        $request->validate([
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts'   => 'required|numeric|min:0|max:100',
            'nilai_uas'   => 'required|numeric|min:0|max:100',
        ]);

        // Cari data KRS
        $krs = \App\Models\Krs::findOrFail($id_krs);

        // Rumus Perhitungan Nilai (Bisa disesuaikan kebijakan kampus)
        // Contoh: Tugas 30%, UTS 30%, UAS 40%
        $akhir = ($request->nilai_tugas * 0.3) + ($request->nilai_uts * 0.3) + ($request->nilai_uas * 0.4);

        // Konversi ke Grade Huruf
        $grade = 'E';
        if ($akhir >= 85) $grade = 'A';
        elseif ($akhir >= 75) $grade = 'B';
        elseif ($akhir >= 60) $grade = 'C';
        elseif ($akhir >= 45) $grade = 'D';

        // Simpan ke Database
        $krs->update([
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts'   => $request->nilai_uts,
            'nilai_uas'   => $request->nilai_uas,
            'nilai_akhir' => $akhir,
            'grade'       => $grade
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan. Nilai Akhir: ' . $akhir . ' (' . $grade . ')');
    }
    // (Nanti di 6.C kita akan tambah method 'show' dan 'update' di sini)
}

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
    public function show(JadwalKuliah $jadwal)
    {
        // Pastikan jadwal ini benar-benar milik dosen yang login (Security)
        if ($jadwal->dosen_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Ambil data KRS (Mahasiswa yang ambil jadwal ini)
        $listMahasiswa = \App\Models\Krs::with('mahasiswa')
            ->where('jadwal_kuliah_id', $jadwal->id)
            ->orderBy('user_id') // Urutkan berdasarkan ID mahasiswa
            ->get();

        return view('dosen.nilai.show', compact('jadwal', 'listMahasiswa'));
    }

    // 3. PROSES SIMPAN NILAI MASSAL (BATCH)
    public function batchUpdate(Request $request, JadwalKuliah $jadwal)
    {
        // Keamanan: Pastikan dosen hanya bisa update jadwal miliknya
        if ($jadwal->dosen_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Validasi input
        $request->validate([
            'grades' => 'required|array',
            'grades.*.krs_id' => 'required|exists:krs,id',
            'grades.*.nilai_tugas' => 'nullable|numeric|min:0|max:100',
            'grades.*.nilai_uts' => 'nullable|numeric|min:0|max:100',
            'grades.*.nilai_uas' => 'nullable|numeric|min:0|max:100',
        ]);

        $updatedCount = 0;

        // Loop setiap data grade yang dikirim
        foreach ($request->grades as $gradeData) {
            // Temukan KRS, pastikan milik jadwal yang benar
            $krs = \App\Models\Krs::where('id', $gradeData['krs_id'])
                                 ->where('jadwal_kuliah_id', $jadwal->id)
                                 ->first();

            if (!$krs) continue; // Lewati jika KRS tidak ditemukan atau tidak cocok

            $tugas = $gradeData['nilai_tugas'] ?? $krs->nilai_tugas ?? 0;
            $uts = $gradeData['nilai_uts'] ?? $krs->nilai_uts ?? 0;
            $uas = $gradeData['nilai_uas'] ?? $krs->nilai_uas ?? 0;


            // Rumus Perhitungan Nilai (Tugas 30%, UTS 30%, UAS 40%)
            $akhir = ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);

            // Konversi ke Grade Huruf
            $grade = 'E';
            if ($akhir >= 85) $grade = 'A';
            elseif ($akhir >= 75) $grade = 'B';
            elseif ($akhir >= 60) $grade = 'C';
            elseif ($akhir >= 45) $grade = 'D';

            // Simpan ke Database
            $krs->update([
                'nilai_tugas' => $tugas,
                'nilai_uts'   => $uts,
                'nilai_uas'   => $uas,
                'nilai_akhir' => $akhir,
                'grade'       => $grade
            ]);

            $updatedCount++;
        }

        return redirect()->back()->with('success', "$updatedCount data nilai mahasiswa berhasil diperbarui.");
    }
}

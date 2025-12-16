<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Ruangan;
use App\Models\Semester; // Added Semester model
use App\Models\JadwalKuliah; // Assuming JadwalKuliah model is used
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalDosen = User::where('role', 'dosen')->count();
        $totalMataKuliah = MataKuliah::count();
        $totalRuangan = Ruangan::count();
        $totalSemester = Semester::count(); // Added totalSemester

        return view('admin.dashboard', compact('totalUsers', 'totalMahasiswa', 'totalDosen', 'totalMataKuliah', 'totalRuangan', 'totalSemester'));
    }

    public function dosenDashboard()
    {
        $dosenId = Auth::id();

        // 1. Ambil semua jadwal yang diajar dosen
        $jadwals = JadwalKuliah::with(['mataKuliah', 'ruangan', 'semester'])
            ->where('dosen_id', $dosenId)
            ->latest()
            ->get();

        // 2. Hitung total mahasiswa unik dari semua jadwal yang diajar
        // Ambil semua ID jadwal
        $jadwalIds = $jadwals->pluck('id');

        // Hitung mahasiswa unik
        $totalMahasiswa = \App\Models\Krs::whereIn('jadwal_kuliah_id', $jadwalIds)
            ->distinct('user_id')
            ->count('user_id');

        return view('dosen.dashboard', compact('jadwals', 'totalMahasiswa'));
    }

    public function mahasiswaDashboard()
    {
        $user = Auth::user();

        // 1. Ambil SEMUA jadwal yang aktif untuk ditampilkan di tabel
        $jadwals = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan'])->latest()->get();

        // 2. Hitung statistik mahasiswa (SKS & IPK)
        $krsSudahDinilai = \App\Models\Krs::with('jadwal.mataKuliah')
            ->where('user_id', $user->id)
            ->whereNotNull('nilai_akhir')
            ->get();

        $totalSks = 0;
        $totalMutu = 0;

        foreach ($krsSudahDinilai as $krs) {
            $sks = $krs->jadwal->mataKuliah->sks;
            $bobot = $this->hitungBobot($krs->grade);
            $totalSks += $sks;
            $totalMutu += ($sks * $bobot);
        }

        $ipk = $totalSks > 0 ? number_format($totalMutu / $totalSks, 2) : 0;

        return view('mahasiswa.dashboard', compact('jadwals', 'totalSks', 'ipk'));
    }

    // Fungsi bantu untuk hitung bobot
    private function hitungBobot($grade)
    {
        switch ($grade) {
            case 'A': return 4.0;
            case 'B': return 3.0;
            case 'C': return 2.0;
            case 'D': return 1.0;
            default: return 0.0;
        }
    }
}


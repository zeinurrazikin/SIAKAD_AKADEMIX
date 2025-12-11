<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaKrsController extends Controller
{
    // 1. HALAMAN KRS SAYA (Lihat apa yang sudah diambil)
    public function index()
    {
        // Ambil data KRS milik user yang sedang login, lengkap dengan data jadwal & matkulnya
        $krsData = Krs::with(['jadwal.mataKuliah', 'jadwal.dosen', 'jadwal.ruangan'])
            ->where('user_id', Auth::id())
            ->get();

        // Kita juga butuh daftar jadwal yang TERSEDIA (untuk dipilih nanti)
        // Logikanya: Tampilkan semua jadwal semester aktif
        // (Sederhana dulu: Tampilkan semua jadwal yang ada)
        $allJadwals = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan'])->latest()->get();

        return view('mahasiswa.krs.index', compact('krsData', 'allJadwals'));
    }

    // 2. PROSES AMBIL JADWAL
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_kuliah_id' => 'required|exists:jadwal_kuliahs,id',
        ]);

        // Cek apakah mahasiswa SUDAH pernah ambil ini sebelumnya?
        $sudahAmbil = Krs::where('user_id', Auth::id())
            ->where('jadwal_kuliah_id', $request->jadwal_kuliah_id)
            ->exists();

        if ($sudahAmbil) {
            return redirect()->back()->with('error', 'Mata kuliah ini sudah Anda ambil!');
        }

        // Jika belum, simpan
        Krs::create([
            'user_id' => Auth::id(),
            'jadwal_kuliah_id' => $request->jadwal_kuliah_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengambil mata kuliah!');
    }

    // 3. PROSES HAPUS (BATAL AMBIL)
    public function destroy($id)
    {
        // Cari data KRS berdasarkan ID, dan pastikan itu MILIK user yang login (biar ga hapus punya orang)
        $krs = Krs::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $krs->delete();

        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }
}

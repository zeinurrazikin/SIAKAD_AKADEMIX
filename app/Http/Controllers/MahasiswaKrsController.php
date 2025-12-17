<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaKrsController extends Controller
{
    // HALAMAN KRS SAYA
    public function index()
    {
        // Ambil data KRS milik user yang sedang login, lengkap dengan data jadwal & matkulnya
        $krsData = Krs::with(['jadwal.mataKuliah', 'jadwal.dosen', 'jadwal.ruangan'])
            ->where('user_id', Auth::id())
            ->get();

        // Kita juga butuh daftar jadwal yang TERSEDIA
        $allJadwals = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan'])->latest()->get();

        return view('mahasiswa.krs.index', compact('krsData', 'allJadwals'));
    }

    // PROSES AMBIL JADWAL
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

    // PROSES HAPUS
    public function destroy($id)
    {
        // Cari data KRS berdasarkan ID
        $krs = Krs::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $krs->delete();

        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }
}

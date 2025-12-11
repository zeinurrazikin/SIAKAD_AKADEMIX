<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\MataKuliah;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalKuliahController extends Controller
{
    // 1. TAMPILKAN JADWAL (Kita buat sederhana dulu biar tidak error pas redirect)
    public function index()
    {
        // Gunakan 'with' agar loading data relasi cepat
        $jadwals = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan', 'semester'])->latest()->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    // 2. FORM TAMBAH (Ini bagian paling krusial)
    public function create()
    {
        // Kita butuh data dari tabel lain untuk pilihan Dropdown
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get(); // Ambil HANYA yang dosen
        $ruangans = Ruangan::all();
        $semesters = Semester::where('aktif', 1)->get(); // Opsional: Ambil semester aktif saja

        return view('admin.jadwal.create', compact('mataKuliahs', 'dosens', 'ruangans', 'semesters'));
    }

    // 3. PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id'       => 'required|exists:users,id',
            'ruangan_id'     => 'required|exists:ruangans,id',
            'semester_id'    => 'required|exists:semesters,id',
            'hari'           => 'required|string',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',
            'kuota'          => 'required|integer',
        ]);

        JadwalKuliah::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dibuat!');
    }

    // Hapus (Kita butuh ini untuk testing nanti)
    public function destroy($id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dihapus!');
    }
}

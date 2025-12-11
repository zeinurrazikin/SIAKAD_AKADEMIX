<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    // 1. TAMPILKAN DAFTAR SEMESTER
    public function index()
    {
        // Urutkan dari yang terbaru dibuat
        $semesters = Semester::latest()->get();
        return view('admin.semester.index', compact('semesters'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.semester.create');
    }

    // 3. PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'nama_semester' => 'required|unique:semesters',
            'aktif' => 'required|boolean', // Harus 1 (Aktif) atau 0 (Tidak)
        ]);

        // Logic Tambahan (Opsional): 
        // Jika semester ini diset AKTIF, maka semester lain harus NON-AKTIF otomatis.
        // Tapi untuk pemula, kita biarkan manual dulu agar tidak ribet.

        Semester::create($request->all());

        return redirect()->route('admin.semester.index')->with('success', 'Semester berhasil dibuat!');
    }

    // 4. FORM EDIT
    public function edit($id)
    {
        $semester = Semester::findOrFail($id);
        return view('admin.semester.edit', compact('semester'));
    }

    // 5. PROSES UPDATE
    public function update(Request $request, $id)
    {
        $semester = Semester::findOrFail($id);

        $request->validate([
            'nama_semester' => 'required|unique:semesters,nama_semester,' . $semester->id,
            'aktif' => 'required|boolean',
        ]);

        $semester->update($request->all());

        return redirect()->route('admin.semester.index')->with('success', 'Semester berhasil diupdate!');
    }

    // 6. HAPUS
    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();
        return redirect()->route('admin.semester.index')->with('success', 'Semester dihapus!');
    }
}

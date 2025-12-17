<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    // TAMPILKAN DAFTAR SEMESTER
    public function index()
    {
        // Urutkan dari yang terbaru dibuat
        $semesters = Semester::latest()->get();
        return view('admin.semester.index', compact('semesters'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.semester.create');
    }

    // PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'nama_semester' => 'required|unique:semesters',
            'aktif' => 'required|boolean',
        ]);

        // Jika semester ini diset AKTIF, maka semester lain harus NON-AKTIF otomatis.

        Semester::create($request->all());

        return redirect()->route('admin.semester.index')->with('success', 'Semester berhasil dibuat!');
    }

    // FORM EDIT
    public function edit($id)
    {
        $semester = Semester::findOrFail($id);
        return view('admin.semester.edit', compact('semester'));
    }

    // PROSES UPDATE
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

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();
        return redirect()->route('admin.semester.index')->with('success', 'Semester dihapus!');
    }
}

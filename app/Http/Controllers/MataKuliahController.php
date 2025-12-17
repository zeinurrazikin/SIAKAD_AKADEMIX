<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    // TAMPILKAN DAFTAR MK
    public function index()
    {
        $mataKuliahs = MataKuliah::with('prodi')->latest()->get();
        return view('admin.matakuliah.index', compact('mataKuliahs'));
    }

    // FORM TAMBAH
    public function create()
    {
        $prodis = Prodi::all();
        return view('admin.matakuliah.create', compact('prodis'));
    }

    // PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliahs',
            'nama_mk' => 'required',
            'sks' => 'required|integer',
            'semester_paket' => 'required|integer',
            'prodi_id' => 'required',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Berhasil disimpan!');
    }

    // FORM EDIT
    // Kita gunakan $id
    public function edit($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $prodis = Prodi::all();

        // Pastikan variabel 'mataKuliah'
        return view('admin.matakuliah.edit', compact('mataKuliah', 'prodis'));
    }

    // PROSES UPDATE
    public function update(Request $request, $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);

        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliahs,kode_mk,' . $mataKuliah->id,
            'nama_mk' => 'required',
            'sks' => 'required|integer',
            'semester_paket' => 'required|integer',
            'prodi_id' => 'required',
        ]);

        $mataKuliah->update($request->all());

        return redirect()->route('admin.matakuliah.index')->with('success', 'Berhasil diupdate!');
    }

    public function destroy($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('success', 'Berhasil dihapus!');
    }
}

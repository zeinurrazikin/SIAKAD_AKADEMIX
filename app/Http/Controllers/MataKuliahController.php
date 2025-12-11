<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    // 1. TAMPILKAN DAFTAR MK
    public function index()
    {
        $mataKuliahs = MataKuliah::with('prodi')->latest()->get();
        return view('admin.matakuliah.index', compact('mataKuliahs'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        $prodis = Prodi::all();
        return view('admin.matakuliah.create', compact('prodis'));
    }

    // 3. PROSES SIMPAN
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

    // 4. FORM EDIT (BAGIAN YANG ERROR TADI)
    // Kita gunakan $id lalu cari manual agar variabel $mataKuliah PASTI ADA.
    public function edit($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id); // Cari data, kalau ga ada error 404
        $prodis = Prodi::all();

        // Pastikan variabel 'mataKuliah' ini sama persis tulisannya dengan di View
        return view('admin.matakuliah.edit', compact('mataKuliah', 'prodis'));
    }

    // 5. PROSES UPDATE
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

    // 6. HAPUS
    public function destroy($id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('success', 'Berhasil dihapus!');
    }
}

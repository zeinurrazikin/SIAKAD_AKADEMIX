<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    // 1. TAMPILKAN DAFTAR RUANGAN
    public function index()
    {
        $ruangans = Ruangan::latest()->get();
        return view('admin.ruangan.index', compact('ruangans'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('admin.ruangan.create');
    }

    // 3. PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|unique:ruangans',
            'nama_ruangan' => 'required',
        ]);

        Ruangan::create($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    // 4. FORM EDIT (Pakai ID biar aman)
    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    // 5. PROSES UPDATE (Pakai ID biar aman)
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'kode_ruangan' => 'required|unique:ruangans,kode_ruangan,' . $ruangan->id,
            'nama_ruangan' => 'required',
        ]);

        $ruangan->update($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diupdate');
    }

    // 6. HAPUS
    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan dihapus');
    }
}

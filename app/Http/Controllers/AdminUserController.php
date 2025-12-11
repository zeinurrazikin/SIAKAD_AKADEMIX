<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    // 1. TAMPILKAN DAFTAR USER
    public function index()
    {
        // Ambil semua data user, urutkan dari yang terbaru
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // 2. TAMPILKAN FORM TAMBAH USER
    public function create()
    {
        return view('admin.users.create');
    }

    // 3. PROSES SIMPAN USER BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:admin,dosen,mahasiswa'], // Validasi role
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // 4. TAMPILKAN FORM EDIT
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // 5. PROSES UPDATE USER
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,dosen,mahasiswa'],
        ]);

        // Update data dasar
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
    }

    // 6. PROSES HAPUS USER
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}

<?php

use App\Models\JadwalKuliah;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $jadwals = [];

    if ($user->role == 'mahasiswa') {
        // Mahasiswa melihat SEMUA jadwal yang aktif
        // (Nanti di tahap KRS kita filter lagi, tapi skrg tampilkan semua dulu)
        $jadwals = JadwalKuliah::with(['mataKuliah', 'dosen', 'ruangan'])->latest()->get();
    } elseif ($user->role == 'dosen') {
        // Dosen HANYA melihat jadwal di mana DIA yang mengajar
        $jadwals = JadwalKuliah::with(['mataKuliah', 'ruangan'])
            ->where('dosen_id', $user->id) // Filter by ID Dosen yang login
            ->get();
    } elseif ($user->role == 'admin') {
        // Admin bisa melihat total data (opsional, buat statistik)
        // Disini kita kosongkan dulu biar dashboard admin bersih
    }

    return view('dashboard', compact('jadwals'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Khusus Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Ini otomatis membuat jalur untuk index, create, store, edit, update, destroy
    Route::resource('users', App\Http\Controllers\AdminUserController::class);
    Route::resource('matakuliah', App\Http\Controllers\MataKuliahController::class);
    Route::resource('ruangan', App\Http\Controllers\RuanganController::class);
    Route::resource('semester', App\Http\Controllers\SemesterController::class);
    Route::resource('jadwal', App\Http\Controllers\JadwalKuliahController::class);
});
// Route Khusus Dosen
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {

    // Halaman List Kelas
    Route::get('/input-nilai', [App\Http\Controllers\DosenNilaiController::class, 'index'])->name('nilai.index');

    // 1. Masuk ke kelas tertentu (Lihat mahasiswa)
    Route::get('/input-nilai/{jadwal}', [App\Http\Controllers\DosenNilaiController::class, 'show'])->name('nilai.show');

    // 2. Simpan Nilai Per Mahasiswa
    Route::put('/input-nilai/simpan/{krs}', [App\Http\Controllers\DosenNilaiController::class, 'update'])->name('nilai.update');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Halaman Khusus Admin
Route::get('/admin/dashboard', function () {
    return "Halo Admin! Ini halaman rahasia.";
})->middleware(['auth', 'role:admin']); // <--- Perhatikan satpamnya

// Halaman Khusus Dosen
Route::get('/dosen/dashboard', function () {
    return "Halo Dosen! Silakan input nilai.";
})->middleware(['auth', 'role:dosen']);
require __DIR__ . '/auth.php';

// Route Khusus Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {

    // Ini akan membuat route:
    // mahasiswa.krs.index (Halaman KRS)
    // mahasiswa.krs.store (Proses Ambil)
    // mahasiswa.krs.destroy (Proses Hapus)
    Route::resource('krs', App\Http\Controllers\MahasiswaKrsController::class)->only(['index', 'store', 'destroy']);
    Route::get('/khs', [App\Http\Controllers\KhsController::class, 'index'])->name('khs.index');
    // ... route khs ...
    Route::get('/transkrip', [App\Http\Controllers\KhsController::class, 'transkrip'])->name('khs.transkrip');
});
// ROUTE TES SEMENTARA (Nanti dihapus)
// Route::get('/test-ambil-manual', function () {
//     // 1. Kita pura-pura jadi mahasiswa yang sedang login
//     $user = App\Models\User::where('role', 'mahasiswa')->first();
//     Auth::login($user);

//     // 2. Kita ambil satu jadwal acak
//     $jadwal = App\Models\JadwalKuliah::first();

//     if (!$jadwal) return "Buat dulu jadwal kuliah di Admin!";

//     // 3. Coba panggil logic simpan manual
//     // Cek duplikat
//     $cek = App\Models\Krs::where('user_id', $user->id)->where('jadwal_kuliah_id', $jadwal->id)->first();
//     if ($cek) return "Tes Gagal: Data sudah ada (Duplikat). Hapus dulu di database/tinker.";

//     // Simpan
//     App\Models\Krs::create([
//         'user_id' => $user->id,
//         'jadwal_kuliah_id' => $jadwal->id
//     ]);

//     return "SUKSES! Berhasil menyimpan KRS untuk user: " . $user->name . " | Matkul ID: " . $jadwal->id;
// });

// Route Tes Hitungan (Nanti dihapus)
// Route::get('/test-ipk', [App\Http\Controllers\KhsController::class, 'testHitung'])->middleware('auth');
<?php

use App\Models\JadwalKuliah;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController; // Add this import

Route::get('/', function () {
    return view('welcome');
});

// Main Dashboard route acts as a dispatcher
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role == 'mahasiswa') {
        return redirect()->route('mahasiswa.dashboard');
    } elseif ($user->role == 'dosen') {
        return redirect()->route('dosen.dashboard');
    } elseif ($user->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }
    // Fallback if role is not recognized or not logged in (should be caught by middleware)
    return redirect()->route('profile.edit'); // Or any other appropriate fallback
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Khusus Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard'); // Admin Dashboard
    // Ini otomatis membuat jalur untuk index, create, store, edit, update, destroy
    Route::resource('users', App\Http\Controllers\AdminUserController::class);
    Route::resource('matakuliah', App\Http\Controllers\MataKuliahController::class);
    Route::resource('ruangan', App\Http\Controllers\RuanganController::class);
    Route::resource('semester', App\Http\Controllers\SemesterController::class);
    Route::resource('jadwal', App\Http\Controllers\JadwalKuliahController::class);
});
// Route Khusus Dosen
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dosenDashboard'])->name('dashboard'); // Dosen Dashboard
    // Halaman List Kelas
    Route::get('/input-nilai', [App\Http\Controllers\DosenNilaiController::class, 'index'])->name('nilai.index');

    // 1. Masuk ke kelas tertentu (Lihat mahasiswa)
    Route::get('/input-nilai/{jadwal}', [App\Http\Controllers\DosenNilaiController::class, 'show'])->name('nilai.show');

    // 2. Simpan Nilai Massal (Batch Update)
    Route::post('/input-nilai/batch-update/{jadwal}', [App\Http\Controllers\DosenNilaiController::class, 'batchUpdate'])->name('nilai.batchUpdate');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Halaman Khusus Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'mahasiswaDashboard'])->name('dashboard'); // Mahasiswa Dashboard
    // Ini akan membuat route:
    // mahasiswa.krs.index (Halaman KRS)
    // mahasiswa.krs.store (Proses Ambil)
    // mahasiswa.krs.destroy (Proses Hapus)
    Route::resource('krs', App\Http\Controllers\MahasiswaKrsController::class)->only(['index', 'store', 'destroy']);
    Route::get('/khs', [App\Http\Controllers\KhsController::class, 'index'])->name('khs.index');
    // ... route khs ...
    Route::get('/transkrip', [App\Http\Controllers\KhsController::class, 'transkrip'])->name('khs.transkrip');
});

require __DIR__ . '/auth.php';

// ROUTE TES SEMENTARA (Nanti dihapus) - KEEP AS-IS or REMOVE IF NO LONGER NEEDED
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

// Route Tes Hitungan (Nanti dihapus) - KEEP AS-IS or REMOVE IF NO LONGER NEEDED
// Route::get('/test-ipk', [App\Http\Controllers\KhsController::class, 'testHitung'])->middleware('auth');
<?php

use App\Models\JadwalKuliah;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role == 'mahasiswa') {
        return redirect()->route('mahasiswa.dashboard');
    } elseif ($user->role == 'dosen') {
        return redirect()->route('dosen.dashboard');
    } elseif ($user->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('profile.edit');
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

    // Masuk ke kelas tertentu
    Route::get('/input-nilai/{jadwal}', [App\Http\Controllers\DosenNilaiController::class, 'show'])->name('nilai.show');

    // Simpan Nilai Massal
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

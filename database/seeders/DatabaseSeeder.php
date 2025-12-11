<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // 1. Akun Admin
        User::create([
            'name' => 'Pak Admin',
            'email' => 'admin@siakad.com',
            'role' => 'admin', // Role Admin
            'password' => Hash::make('password123'),
        ]);
        // 2. Akun Dosen
        User::create([
            'name' => 'Budi Santoso, M.Kom',
            'email' => 'dosen@siakad.com',
            'role' => 'dosen', // Role Dosen
            'password' => Hash::make('password123'),
        ]);

        // 3. Akun Mahasiswa
        User::create([
            'name' => 'Andi Mahasiswa',
            'email' => 'mahasiswa@siakad.com',
            'role' => 'mahasiswa', // Role Mahasiswa
            'password' => Hash::make('password123'),
        ]);
        \App\Models\Prodi::create([
            'kode_prodi' => 'TI',
            'nama_prodi' => 'Teknik Informatika',
        ]);

        \App\Models\Prodi::create([
            'kode_prodi' => 'SI',
            'nama_prodi' => 'Sistem Informasi',
        ]);
    }
}

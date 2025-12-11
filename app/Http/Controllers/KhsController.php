<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhsController extends Controller
{
    // Fungsi bantu untuk hitung bobot (Private saja)
    private function hitungBobot($grade)
    {
        switch ($grade) {
            case 'A':
                return 4;
            case 'B':
                return 3;
            case 'C':
                return 2;
            case 'D':
                return 1;
            default:
                return 0;
        }
    }

    // 1. HALAMAN KHS (Utama)
    public function index()
    {
        $user = Auth::user();

        // Ambil semua KRS milik mahasiswa, urutkan biar semester terbaru di atas
        // Kita juga butuh data Semester untuk pengelompokan
        $krsData = Krs::with(['jadwal.mataKuliah', 'jadwal.semester', 'jadwal.dosen'])
            ->where('user_id', $user->id)
            ->whereNotNull('nilai_akhir') // Hanya yang sudah dinilai
            ->get()
            ->groupBy('jadwal.semester.nama_semester'); // KELOMPOKKAN PER SEMESTER

        // Kita siapkan array untuk menampung hasil hitungan per semester
        $hasilStudi = [];

        foreach ($krsData as $semesterNama => $groupKrs) {
            $totalSks = 0;
            $totalMutu = 0;

            foreach ($groupKrs as $krs) {
                $sks = $krs->jadwal->mataKuliah->sks;
                $bobot = $this->hitungBobot($krs->grade);

                $totalSks += $sks;
                $totalMutu += ($sks * $bobot);
            }

            // Hitung IP Semester (IPS)
            $ips = $totalSks > 0 ? number_format($totalMutu / $totalSks, 2) : 0;

            // Simpan ke array untuk dikirim ke View
            $hasilStudi[] = [
                'semester_nama' => $semesterNama,
                'data_matkul' => $groupKrs,
                'total_sks' => $totalSks,
                'ips' => $ips
            ];
        }

        return view('mahasiswa.khs.index', compact('user', 'hasilStudi'));
    }

    // 2. HALAMAN TRANSKRIP (REKAP SEMUA NILAI)
    public function transkrip()
    {
        $user = Auth::user();

        // Ambil SEMUA data KRS yang sudah dinilai (Tanpa grouping semester)
        // Kita urutkan berdasarkan Kode Mata Kuliah agar rapi
        $transkrip = Krs::with(['jadwal.mataKuliah', 'jadwal.semester'])
            ->where('user_id', $user->id)
            ->whereNotNull('nilai_akhir')
            ->get()
            ->sortBy('jadwal.mataKuliah.kode_mk'); // Urutkan kode MK

        // Hitung IPK (Kumulatif)
        $totalSks = 0;
        $totalMutu = 0;

        foreach ($transkrip as $data) {
            $sks = $data->jadwal->mataKuliah->sks;
            $bobot = $this->hitungBobot($data->grade); // Pakai fungsi private tadi

            $totalSks += $sks;
            $totalMutu += ($sks * $bobot);
        }

        // Rumus IPK
        $ipk = $totalSks > 0 ? number_format($totalMutu / $totalSks, 2) : 0;

        return view('mahasiswa.khs.transkrip', compact('user', 'transkrip', 'totalSks', 'totalMutu', 'ipk'));
    }
}

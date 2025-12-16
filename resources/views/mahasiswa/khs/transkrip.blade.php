<x-app-layout>
    <!-- Header -->
    <div class="relative bg-gradient-to-r from-amber-800 via-yellow-800 to-amber-900 pb-24 overflow-hidden no-print">
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-bold leading-8 text-white sm:text-4xl tracking-tight">
                    Transkrip Nilai Akademik
                </h2>
                <p class="mt-3 text-yellow-100">
                    Rekam jejak akademik lengkap Anda selama masa studi.
                </p>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4 no-print">
                <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center gap-2 rounded-md bg-white/90 backdrop-blur-sm px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 border border-white/30 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>
                <button onclick="window.print()" class="inline-flex items-center gap-2 rounded-md bg-indigo-600/90 backdrop-blur-sm px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 border border-indigo-500/50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Transkrip
                </button>
            </div>

            <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg border-white/30 overflow-hidden p-8">
                <div class="text-center mb-8 border-b pb-4">
                    <h1 class="text-2xl font-bold uppercase tracking-widest">Transkrip Nilai Sementara</h1>
                    <p class="text-gray-500">Universitas Laravel Indonesia</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div>
                        <table class="text-sm">
                            <tr>
                                <td class="w-32 font-bold text-gray-600">Nama Lengkap</td>
                                <td class="px-2">:</td>
                                <td class="font-bold">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold text-gray-600">NIM / Email</td>
                                <td class="px-2">:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Tanggal Cetak: {{ date('d F Y') }}</p>
                    </div>
                </div>

                @if($transkrip->isEmpty())
                <p class="text-center text-gray-500 italic py-8">Belum ada data akademik yang terekam.</p>
                @else
                <table class="w-full text-sm border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-center w-12">No</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Kode MK</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Mata Kuliah</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Semester</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">SKS</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Nilai</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Mutu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $no = 1;
                            $currentSemester = null;
                        @endphp
                        @foreach($transkrip as $krs)
                        @php
                            $bobot = match($krs->grade) { 'A'=>4, 'B'=>3, 'C'=>2, 'D'=>1, default=>0 };
                            $mutu = $krs->jadwal->mataKuliah->sks * $bobot;
                            $semester = $krs->jadwal->semester->nama_semester;
                        @endphp
                        
                        @if($currentSemester != $semester)
                            @php $currentSemester = $semester; @endphp
                            <tr class="bg-gray-50 font-semibold">
                                <td colspan="7" class="border border-gray-300 px-4 py-2 text-gray-700">{{ $semester }}</td>
                            </tr>
                        @endif

                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $no++ }}</td>
                            <td class="border border-gray-300 px-4 py-2 font-mono">{{ $krs->jadwal->mataKuliah->kode_mk }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $krs->jadwal->mataKuliah->nama_mk }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center text-xs text-gray-500">
                                {{ $semester }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $krs->jadwal->mataKuliah->sks }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center font-bold">{{ $krs->grade }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $mutu }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-100 font-bold">
                        <tr>
                            <td colspan="4" class="border border-gray-300 px-4 py-2 text-right">TOTAL</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $totalSks }}</td>
                            <td class="border border-gray-300 px-4 py-2 bg-gray-200"></td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $totalMutu }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-8 border-t-2 border-gray-300 pt-4 flex justify-end">
                    <table class="w-72 text-base">
                        <tr>
                            <td class="text-gray-600 font-bold">Total SKS</td>
                            <td class="text-right font-bold">{{ $totalSks }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 font-bold">Total Mutu</td>
                            <td class="text-right font-bold">{{ $totalMutu }}</td>
                        </tr>
                        <tr class="text-xl text-blue-800">
                            <td class="font-extrabold pt-2">IPK</td>
                            <td class="text-right font-extrabold pt-2">{{ $ipk }}</td>
                        </tr>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </main>

    <style>
        @media print {
            .no-print, .no-print * {
                display: none !important;
            }
            body {
                background: white !important;
            }
            main {
                margin-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .bg-white\/95 { /* Specificity to override utility class */
                background-color: white !important;
                box-shadow: none !important;
                border: none !important;
            }
        }
    </style>
</x-app-layout>
<x-app-layout>
    <div class="relative bg-gradient-to-br from-blue-900 via-sky-800 to-blue-800 pb-32 overflow-hidden">
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-extrabold leading-8 text-white sm:text-4xl tracking-tight">
                    Input Nilai: <span class="text-indigo-300">{{ $jadwal->mataKuliah->nama_mk }}</span>
                </h2>
                <p class="mt-2 text-indigo-200">
                    Kelas pada hari {{ $jadwal->hari }}, pukul {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}.
                </p>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-start mb-4">
                <a href="{{ route('dosen.dashboard') }}" class="inline-flex items-center gap-2 rounded-md bg-white/90 backdrop-blur-sm px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 border border-white/30 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            @if(session('success'))
            <div class="rounded-md bg-green-50 p-4 mb-6 shadow-sm border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg border border-white/30 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100/50">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Mahasiswa</h3>
                    <p class="text-sm text-gray-500">Input nilai Tugas, UTS, dan UAS. Nilai Akhir & Grade akan dihitung otomatis saat disimpan.</p>
                </div>

                @if($listMahasiswa->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    Belum ada mahasiswa yang mengambil kelas ini.
                </div>
                @else
                <form action="{{ route('dosen.nilai.batchUpdate', $jadwal->id) }}" method="POST">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100">
                                <tr class="text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    <th class="p-4">Nama Mahasiswa</th>
                                    <th class="p-4 text-center">Tugas (30%)</th>
                                    <th class="p-4 text-center">UTS (30%)</th>
                                    <th class="p-4 text-center">UAS (40%)</th>
                                    <th class="p-4 text-center">Nilai Akhir</th>
                                    <th class="p-4 text-center">Grade</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($listMahasiswa as $mhs)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4">
                                        <input type="hidden" name="grades[{{ $loop->index }}][krs_id]" value="{{ $mhs->id }}">
                                        <div class="font-semibold text-gray-900">{{ $mhs->mahasiswa->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $mhs->mahasiswa->nim }}</div>
                                    </td>
                                    <td class="p-2 align-middle">
                                        <input type="number" name="grades[{{ $loop->index }}][nilai_tugas]" value="{{ $mhs->nilai_tugas ?? '' }}" class="w-24 text-center border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="0-100" min="0" max="100">
                                    </td>
                                    <td class="p-2 align-middle">
                                        <input type="number" name="grades[{{ $loop->index }}][nilai_uts]" value="{{ $mhs->nilai_uts ?? '' }}" class="w-24 text-center border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="0-100" min="0" max="100">
                                    </td>
                                    <td class="p-2 align-middle">
                                        <input type="number" name="grades[{{ $loop->index }}][nilai_uas]" value="{{ $mhs->nilai_uas ?? '' }}" class="w-24 text-center border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="0-100" min="0" max="100">
                                    </td>
                                    <td class="p-4 text-center align-middle">
                                        <span class="font-bold text-blue-600 text-base">{{ $mhs->nilai_akhir ?? '-' }}</span>
                                    </td>
                                    <td class="p-4 text-center align-middle">
                                        @if($mhs->grade)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                                            @switch($mhs->grade)
                                                @case('A') bg-green-100 text-green-800 @break
                                                @case('B') bg-blue-100 text-blue-800 @break
                                                @case('C') bg-yellow-100 text-yellow-800 @break
                                                @case('D') bg-orange-100 text-orange-800 @break
                                                @default bg-red-100 text-red-800 @break
                                            @endswitch">
                                            {{ $mhs->grade }}
                                        </span>
                                        @else
                                        <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-6 bg-gray-50 border-t border-gray-200 flex justify-end items-center">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            Simpan Semua Perubahan
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </main>
</x-app-layout>
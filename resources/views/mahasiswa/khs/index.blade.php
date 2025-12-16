<x-app-layout>
    <!-- Header -->
    <div class="relative bg-gradient-to-r from-sky-800 via-cyan-800 to-sky-900 pb-24 overflow-hidden">
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-bold leading-8 text-white sm:text-4xl tracking-tight">
                    Kartu Hasil Studi (KHS)
                </h2>
                <p class="mt-3 text-cyan-100">
                    Rangkuman hasil studi Anda per semester.
                </p>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-start mb-4">
                <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center gap-2 rounded-md bg-white/90 backdrop-blur-sm px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 border border-white/30 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/30 p-6 mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Nama Mahasiswa</p>
                        <p class="font-bold text-lg text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email / NIM</p>
                        <p class="font-bold text-lg text-gray-900">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            @if(empty($hasilStudi))
            <div class="text-center py-10 px-6 bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border-white/30">
                <div class="inline-flex items-center justify-center h-14 w-14 rounded-full bg-yellow-100 text-yellow-500 mb-4">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-medium text-gray-900">Belum Ada Nilai</h3>
                <p class="text-sm text-gray-500">Belum ada nilai yang keluar. Silakan tunggu dosen menginput nilai.</p>
            </div>
            @else
            <div class="space-y-8">
                @foreach($hasilStudi as $khs)
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow border-white/30 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100/50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">
                            📂 {{ $khs['semester_nama'] }}
                        </h3>
                        <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold text-sm">
                            IPS: <span class="text-lg">{{ $khs['ips'] }}</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="p-4">Kode</th>
                                    <th class="p-4">Mata Kuliah</th>
                                    <th class="p-4 text-center">SKS</th>
                                    <th class="p-4 text-center">Nilai Angka</th>
                                    <th class="p-4 text-center">Grade</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($khs['data_matkul'] as $mk)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-4 font-mono">{{ $mk->jadwal->mataKuliah->kode_mk }}</td>
                                    <td class="p-4 font-medium text-gray-900">
                                        {{ $mk->jadwal->mataKuliah->nama_mk }}
                                    </td>
                                    <td class="p-4 text-center">{{ $mk->jadwal->mataKuliah->sks }}</td>
                                    <td class="p-4 text-center">{{ $mk->nilai_akhir }}</td>
                                    <td class="p-4 text-center font-bold">
                                        @php
                                        $color = match($mk->grade) {
                                        'A' => 'bg-green-100 text-green-800',
                                        'B' => 'bg-blue-100 text-blue-800',
                                        'C' => 'bg-yellow-100 text-yellow-800',
                                        default => 'bg-red-100 text-red-800',
                                        };
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-sm {{ $color }}">{{ $mk->grade }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-100 font-bold">
                                <tr>
                                    <td colspan="2" class="p-4 text-right">Total SKS Semester:</td>
                                    <td class="p-4 text-center text-blue-800">{{ $khs['total_sks'] }}</td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </main>
</x-app-layout>
<x-app-layout>
    <!-- Header -->
    <div class="relative bg-gradient-to-br from-blue-900 via-sky-800 to-blue-800 pb-32 overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute inset-0 bg-[url('https://redaksi.duta.co/wp-content/uploads/2023/03/poliwangi.jpeg')] bg-cover bg-center mix-blend-overlay"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="text-3xl font-extrabold leading-8 text-white sm:text-4xl tracking-tight">
                        Dosen Portal
                    </h2>
                    <p class="mt-2 text-sky-200">
                        Selamat datang kembali, <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
                    </p>
                </div>
                <div class="mt-4 flex flex-col sm:flex-row gap-3 md:ml-4 md:mt-0">
                    <div class="flex items-center gap-2 px-4 py-2 bg-green-500/20 backdrop-blur-md rounded-full border border-green-400/30">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
                        </span>
                        <span class="text-sm font-medium text-green-100">Online</span>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-black/20 px-4 py-2 text-sm font-medium text-white backdrop-blur-sm border border-white/10">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2 mb-8">
                @php
                    $stats = [
                        ['label' => 'Total Kelas Diajar', 'value' => $jadwals->count(), 'color' => 'sky', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['label' => 'Total Mahasiswa', 'value' => $totalMahasiswa, 'color' => 'indigo', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="relative overflow-hidden rounded-xl bg-white/95 p-6 shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] backdrop-blur-sm border border-white/30">
                        <div class="flex items-center">
                            <div class="rounded-lg bg-{{ $stat['color'] }}-100 p-4">
                                <svg class="h-7 w-7 text-{{ $stat['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stat['value'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Main Content Grid -->
            <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg border border-white/30 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100/50">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Kelas</h3>
                    <p class="text-sm text-gray-500">Pilih kelas untuk memulai input nilai mahasiswa.</p>
                </div>
                <div class="p-6">
                     @if($jadwals->isEmpty())
                        <div class="text-center py-10 px-6 bg-gray-50 rounded-lg">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Jadwal Kosong</h3>
                            <p class="mt-1 text-sm text-gray-500">Anda belum memiliki jadwal mengajar yang terdaftar.</p>
                        </div>
                    @else
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr class="text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                    <th class="p-4">Mata Kuliah</th>
                                    <th class="p-4">Jadwal & Ruang</th>
                                    <th class="p-4">Semester</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($jadwals as $j)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-900">{{ $j->mataKuliah->nama_mk }}</div>
                                        <div class="text-xs text-gray-500">{{ $j->mataKuliah->kode_mk }} | {{ $j->mataKuliah->sks }} SKS</div>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <div>{{ $j->hari }}, {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 mt-1">
                                            {{ $j->ruangan->nama_ruangan }}
                                        </span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap text-gray-700">{{ $j->semester->nama_semester }}</td>
                                    <td class="p-4 text-center">
                                        <a href="{{ route('dosen.nilai.show', $j->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all">
                                            Input Nilai
                                            <svg class="ml-2 -mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

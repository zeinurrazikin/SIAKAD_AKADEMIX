<x-app-layout>
    <div class="relative h-[calc(100vh-65px)] bg-gray-50 overflow-hidden font-sans flex flex-col">

        <div class="flex-1 flex flex-col max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-4 gap-4 relative z-10">

            <div class="flex items-center justify-between shrink-0">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 tracking-tight flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/30 text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                        </div>
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">
                            Mahasiswa
                        </span>
                    </h2>
                    <p class="text-gray-500 text-xs ml-14">
                        Selamat datang, <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    </p>
                </div>

                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-white/60 backdrop-blur-md rounded-full border border-white shadow-sm">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-xs font-semibold text-gray-600">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>

            <div class="flex-1 min-h-0 grid grid-cols-12 grid-rows-6 gap-5">

                <div class="col-span-6 lg:col-span-3 row-span-1 relative overflow-hidden rounded-2xl bg-white p-4 shadow-sm border border-indigo-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-indigo-50 group-hover:bg-indigo-100 transition-colors"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Indeks Prestasi</p>
                            <p class="text-3xl font-black text-gray-800 mt-1">{{ $ipk }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-indigo-500 text-white flex items-center justify-center shadow-lg shadow-indigo-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        </div>
                    </div>
                </div>

                <div class="col-span-6 lg:col-span-3 row-span-1 relative overflow-hidden rounded-2xl bg-white p-4 shadow-sm border border-rose-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-rose-50 group-hover:bg-rose-100 transition-colors"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-rose-500 uppercase tracking-wider">Total SKS</p>
                            <p class="text-3xl font-black text-gray-800 mt-1">{{ $totalSks }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-rose-500 text-white flex items-center justify-center shadow-lg shadow-rose-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        </div>
                    </div>
                </div>

                <div class="col-span-6 lg:col-span-3 row-span-1 relative overflow-hidden rounded-2xl bg-white p-4 shadow-sm border border-amber-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-amber-50 group-hover:bg-amber-100 transition-colors"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-amber-500 uppercase tracking-wider">Semester</p>
                            <div class="flex items-baseline gap-2 mt-1">
                                <p class="text-2xl font-black text-gray-800">Ganjil</p>
                                <span class="text-[10px] font-bold bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded">25/26</span>
                            </div>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    </div>
                </div>

                <div class="col-span-6 lg:col-span-3 row-span-1 relative overflow-hidden rounded-2xl bg-white p-4 shadow-sm border border-emerald-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-emerald-50 group-hover:bg-emerald-100 transition-colors"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-emerald-500 uppercase tracking-wider">Status</p>
                            <p class="text-xl font-black text-emerald-600 mt-1 uppercase tracking-wide">Mahasiswa Aktif</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-9 row-span-5 bg-white/80 backdrop-blur-xl rounded-2xl shadow-sm border border-white flex flex-col overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-white/60 flex justify-between items-center shrink-0">
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg bg-blue-50 text-blue-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm">Jadwal Kuliah</h3>
                                <p class="text-[10px] text-gray-500">Minggu Ini</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 rounded-md bg-blue-50 text-blue-600 text-[10px] font-bold border border-blue-100 animate-pulse">LIVE CLASS</span>
                    </div>
                    
                    <div class="flex-1 overflow-y-auto custom-scrollbar p-0">
                        @if($jadwals->isEmpty())
                            <div class="h-full flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-16 h-16 mb-4 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                                <p class="text-sm font-medium text-gray-500">Belum ada jadwal kuliah.</p>
                            </div>
                        @else
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-gray-500 uppercase bg-gray-50/80 sticky top-0 backdrop-blur-md z-10">
                                    <tr>
                                        <th class="px-6 py-3 font-bold tracking-wider text-gray-600">Mata Kuliah</th>
                                        <th class="px-6 py-3 font-bold tracking-wider text-gray-600">Waktu</th>
                                        <th class="px-6 py-3 font-bold tracking-wider text-gray-600">Dosen</th>
                                        <th class="px-6 py-3 font-bold tracking-wider text-gray-600">Ruangan</th>
                                        <th class="px-6 py-3 text-center font-bold tracking-wider text-gray-600">SKS</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($jadwals as $j)
                                        <tr class="hover:bg-blue-50/50 transition-colors group">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-indigo-400 to-blue-500 text-white flex items-center justify-center font-bold text-sm shadow-md shadow-blue-200 shrink-0">
                                                        {{ substr($j->mataKuliah->nama_mk, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-gray-800 group-hover:text-blue-600 transition line-clamp-1">{{ $j->mataKuliah->nama_mk }}</div>
                                                        <div class="text-[10px] text-gray-400 font-mono mt-0.5">{{ $j->mataKuliah->kode_mk }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex flex-col">
                                                    <span class="font-semibold text-gray-700">{{ $j->hari }}</span>
                                                    <span class="text-[10px] text-gray-500 font-mono bg-gray-100 px-2 py-0.5 rounded-full w-fit mt-1 border border-gray-200">
                                                        {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    <div class="h-6 w-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 shrink-0">
                                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                    </div>
                                                    <span class="text-xs font-medium text-gray-600 line-clamp-1">{{ $j->dosen->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-teal-50 text-teal-600 border border-teal-100 whitespace-nowrap">
                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                    {{ $j->ruangan->nama_ruangan }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="font-bold text-xs text-gray-600 bg-white border border-gray-200 px-2 py-1 rounded-md shadow-sm">{{ $j->mataKuliah->sks }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-3 row-span-5 flex flex-col gap-4">
                    
                    <div class="flex items-center gap-2 px-1">
                        <span class="h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
                        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest">Menu Pintas</h3>
                    </div>

                    <div class="flex-1 bg-white/80 backdrop-blur-xl rounded-2xl border border-white shadow-sm p-4 flex flex-col gap-3 overflow-y-auto">
                        
                        <a href="{{ route('mahasiswa.krs.index') }}" class="group relative overflow-hidden rounded-xl bg-white border border-indigo-100 p-4 hover:border-indigo-300 hover:shadow-lg hover:shadow-indigo-100 transition-all duration-300">
                            <div class="relative flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-sm shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-800 text-sm group-hover:text-indigo-700 transition-colors truncate">Isi KRS</h4>
                                    <p class="text-[10px] text-gray-500 truncate">Rencana Studi Baru</p>
                                </div>
                                <div class="h-6 w-6 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                                    <svg class="w-3 h-3 text-gray-400 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('mahasiswa.khs.index') }}" class="group relative overflow-hidden rounded-xl bg-white border border-sky-100 p-4 hover:border-sky-300 hover:shadow-lg hover:shadow-sky-100 transition-all duration-300">
                            <div class="relative flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-sky-50 flex items-center justify-center text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition-all duration-300 shadow-sm shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-800 text-sm group-hover:text-sky-700 transition-colors truncate">Lihat KHS</h4>
                                    <p class="text-[10px] text-gray-500 truncate">Hasil Studi Semester</p>
                                </div>
                                <div class="h-6 w-6 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-sky-100 transition-colors">
                                    <svg class="w-3 h-3 text-gray-400 group-hover:text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('mahasiswa.khs.transkrip') }}" class="group relative overflow-hidden rounded-xl bg-white border border-amber-100 p-4 hover:border-amber-300 hover:shadow-lg hover:shadow-amber-100 transition-all duration-300">
                            <div class="relative flex items-center gap-3">
                                <div class="h-10 w-10 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-800 text-sm group-hover:text-amber-700 transition-colors truncate">Transkrip</h4>
                                    <p class="text-[10px] text-gray-500 truncate">Riwayat Nilai</p>
                                </div>
                                <div class="h-6 w-6 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                                    <svg class="w-3 h-3 text-gray-400 group-hover:text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </div>
                            </div>
                        </a>

                    </div>

                    <div class="bg-white/60 backdrop-blur rounded-xl border border-white p-3 text-center shadow-sm shrink-0">
                        <p class="text-[10px] text-gray-400 font-medium">© {{ date('Y') }} AkademiX v2.0</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
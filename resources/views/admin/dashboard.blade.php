<x-app-layout>
    <div class="relative bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800 pb-32 overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute inset-0 bg-[url('https://poliwangi.ac.id/wp-content/uploads/2024/12/IMG_9667-scaled-1.jpg')] bg-cover bg-center mix-blend-overlay"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="text-3xl font-extrabold leading-8 text-white sm:text-4xl tracking-tight">
                        Dashboard Admin
                    </h2>
                    <p class="mt-2 text-indigo-200">
                        Selamat datang, <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
                    </p>
                </div>
                <div class="mt-4 flex flex-col sm:flex-row gap-3 md:ml-4 md:mt-0">
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
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                @php
                    $stats = [
                        ['label' => 'Total Pengguna', 'value' => $totalUsers, 'color' => 'indigo', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                        ['label' => 'Mahasiswa', 'value' => $totalMahasiswa, 'color' => 'rose', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['label' => 'Total Dosen', 'value' => $totalDosen, 'color' => 'emerald', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['label' => 'Mata Kuliah', 'value' => $totalMataKuliah, 'color' => 'amber', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253']
                    ];
                @endphp

                @foreach ($stats as $stat)
                    <div class="relative overflow-hidden rounded-xl bg-white/90 p-6 shadow transition-all duration-300 hover:shadow-xl hover:scale-[1.02] backdrop-blur-sm border border-white/20">
                        <div class="flex items-center">
                            <div class="rounded-lg bg-{{ $stat['color'] }}-50 p-3">
                                <svg class="h-6 w-6 text-{{ $stat['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">{{ $stat['label'] }}</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stat['value'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Quick Actions -->
                <div class="lg:col-span-2">
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow border border-white/30 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100/50">
                            <h3 class="text-lg font-bold text-gray-800">Manajemen Cepat</h3>
                            <p class="text-sm text-gray-500">Akses modul inti sistem Akademix</p>
                        </div>
                        <div class="p-6 grid grid-cols-2 md:grid-cols-3 gap-4">
                            @php
                                $actions = [
                                    ['label' => 'Users', 'route' => 'admin.users.index', 'color' => 'indigo', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                                    ['label' => 'Mata Kuliah', 'route' => 'admin.matakuliah.index', 'color' => 'amber', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                                    ['label' => 'Jadwal', 'route' => 'admin.jadwal.index', 'color' => 'blue', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                    ['label' => 'Ruangan', 'route' => 'admin.ruangan.index', 'color' => 'teal', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                                    ['label' => 'Semester', 'route' => 'admin.semester.index', 'color' => 'purple', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10']
                                ];
                            @endphp

                            @foreach ($actions as $action)
                                <a href="{{ route($action['route']) }}" class="group flex flex-col items-center justify-center p-4 rounded-lg border border-gray-200/60 bg-white/70 hover:bg-{{ $action['color'] }}-50 hover:border-{{ $action['color'] }}-300 transition-all duration-200">
                                    <div class="h-12 w-12 rounded-lg bg-{{ $action['color'] }}-100 flex items-center justify-center text-{{ $action['color'] }}-700 mb-2 group-hover:bg-{{ $action['color'] }}-600 group-hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}" />
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700 group-hover:text-{{ $action['color'] }}-700">{{ $action['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Summary Panel -->
                <div class="space-y-6">
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow border border-white/30 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100/50">
                            <h3 class="text-base font-bold text-gray-800">Ringkasan Infrastruktur</h3>
                        </div>
                        <div class="p-6 space-y-5">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center text-green-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Total Ruangan</p>
                                        <p class="text-xs text-gray-500">Kelas & Lab</p>
                                    </div>
                                </div>
                                <span class="text-xl font-bold text-gray-900">{{ $totalRuangan }}</span>
                            </div>

                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center text-purple-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Semester Aktif</p>
                                        <p class="text-xs text-gray-500">T.A. 2025/2026</p>
                                    </div>
                                </div>
                                <span class="text-xl font-bold text-gray-900">{{ $totalSemester }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
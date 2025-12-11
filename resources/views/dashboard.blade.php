<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900">
                    Halo, {{ Auth::user()->name }}!
                    <span class="text-sm font-normal text-gray-500">({{ ucfirst(Auth::user()->role) }})</span>
                </h3>
                <p class="text-gray-600 mt-1">Selamat datang di Sistem Informasi Akademik.</p>
            </div>

            @if(Auth::user()->role == 'mahasiswa')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-blue-800">📅 Jadwal Kuliah Semester Ini</h3>

                @if(isset($jadwals) && count($jadwals) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">Hari & Jam</th>
                                <th class="px-6 py-3">Mata Kuliah</th>
                                <th class="px-6 py-3">Dosen</th>
                                <th class="px-6 py-3">Ruangan</th>
                                <th class="px-6 py-3">SKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $j)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $j->hari }} <br>
                                    <span class="text-xs text-gray-500">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $j->mataKuliah->nama_mk }} <br>
                                    <span class="text-xs text-gray-400">{{ $j->mataKuliah->kode_mk }}</span>
                                </td>
                                <td class="px-6 py-4">{{ $j->dosen->name }}</td>
                                <td class="px-6 py-4">{{ $j->ruangan->nama_ruangan }}</td>
                                <td class="px-6 py-4 text-center">{{ $j->mataKuliah->sks }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-gray-500 italic">Belum ada jadwal kuliah yang tersedia untuk semester ini.</p>
                @endif
            </div>
            @endif

            @if(Auth::user()->role == 'dosen')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-green-800">👨‍🏫 Jadwal Mengajar Anda</h3>
                @if(isset($jadwals) && count($jadwals) > 0)
                <ul class="space-y-3">
                    @foreach($jadwals as $j)
                    <li class="p-4 border border-green-200 rounded-lg bg-green-50 flex justify-between items-center">
                        <div>
                            <strong class="block text-lg">{{ $j->mataKuliah->nama_mk }}</strong>
                            <span class="text-sm text-gray-600">Hari {{ $j->hari }}, {{ $j->jam_mulai }} - {{ $j->jam_selesai }}</span>
                        </div>
                        <div class="text-right">
                            <span class="block font-bold text-gray-700">{{ $j->ruangan->nama_ruangan }}</span>
                            <span class="text-xs text-gray-500">SKS: {{ $j->mataKuliah->sks }}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-gray-500 italic">Anda belum memiliki jadwal mengajar.</p>
                @endif
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
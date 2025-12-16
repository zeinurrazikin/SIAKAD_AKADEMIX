<x-app-layout>
    <!-- Header -->
    <div class="relative bg-gradient-to-r from-indigo-800 via-purple-800 to-indigo-900 pb-24 overflow-hidden">
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-bold leading-8 text-white sm:text-4xl tracking-tight">
                    Isi Kartu Rencana Studi (KRS)
                </h2>
                <p class="mt-3 text-purple-100">
                    Pilih mata kuliah yang akan Anda ambil untuk semester ini.
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

            @if(session('error'))
            <div class="rounded-md bg-red-50 p-4 mb-6 shadow-sm border border-red-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow border-white/30 overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100/50">
                    <h3 class="text-lg font-bold text-gray-800">📚 Mata Kuliah yang Anda Ambil</h3>
                </div>
                <div class="p-6">
                    @if($krsData->isEmpty())
                    <p class="text-gray-500 italic bg-gray-50 p-4 rounded text-center">Anda belum mengambil mata kuliah apapun.</p>
                    @else
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="p-4">Mata Kuliah</th>
                                    <th class="p-4">Dosen</th>
                                    <th class="p-4">Jadwal</th>
                                    <th class="p-4 text-center">SKS</th>
                                    <th class="p-4 text-center">Grade</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($krsData as $krs)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-4 font-medium text-gray-900">
                                        {{ $krs->jadwal->mataKuliah->nama_mk }} <br>
                                        <span class="text-xs text-gray-500">{{ $krs->jadwal->mataKuliah->kode_mk }}</span>
                                    </td>
                                    <td class="p-4">{{ $krs->jadwal->dosen->name }}</td>
                                    <td class="p-4">
                                        {{ $krs->jadwal->hari }}, {{ \Carbon\Carbon::parse($krs->jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($krs->jadwal->jam_selesai)->format('H:i') }} <br>
                                        <span class="text-xs font-bold bg-gray-100 text-gray-800 px-2 py-1 rounded">{{ $krs->jadwal->ruangan->nama_ruangan }}</span>
                                    </td>
                                    <td class="p-4 text-center">{{ $krs->jadwal->mataKuliah->sks }}</td>
                                    <td class="p-4 text-center font-bold">
                                        <span class="text-blue-600">{{ $krs->grade ?? '-' }}</span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <form action="{{ route('mahasiswa.krs.destroy', $krs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan mata kuliah ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-xs font-bold transition">
                                                Batalkan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow border-white/30 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-gray-100/50">
                    <h3 class="text-lg font-bold text-gray-800">✅ Jadwal Kuliah Tersedia</h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="p-4">Mata Kuliah</th>
                                    <th class="p-4">Dosen</th>
                                    <th class="p-4">Jadwal & Ruang</th>
                                    <th class="p-4 text-center">SKS</th>
                                    <th class="p-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($allJadwals as $jadwal)
                                @php
                                $sudahDiambil = $krsData->contains('jadwal_kuliah_id', $jadwal->id);
                                @endphp

                                <tr class="hover:bg-gray-50 {{ $sudahDiambil ? 'opacity-60 bg-gray-50' : '' }}">
                                    <td class="p-4 font-medium text-gray-900">
                                        {{ $jadwal->mataKuliah->nama_mk }}
                                    </td>
                                    <td class="p-4">{{ $jadwal->dosen->name }}</td>
                                    <td class="p-4">
                                        {{ $jadwal->hari }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }} <br>
                                        <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">{{ $jadwal->ruangan->nama_ruangan }}</span>
                                    </td>
                                    <td class="p-4 text-center">{{ $jadwal->mataKuliah->sks }}</td>
                                    <td class="p-4 text-center">
                                        @if($sudahDiambil)
                                        <span class="text-xs font-bold text-green-600 border border-green-200 bg-green-50 px-3 py-1 rounded-full">Sudah Diambil</span>
                                        @else
                                        <form action="{{ route('mahasiswa.krs.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="jadwal_kuliah_id" value="{{ $jadwal->id }}">
                                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-xs font-bold transition shadow">
                                                + Ambil
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
</x-app-layout>
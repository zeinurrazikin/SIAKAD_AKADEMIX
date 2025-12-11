<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kartu Rencana Studi (KRS)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8 border-l-4 border-blue-500">
                <h3 class="text-lg font-bold mb-4 text-gray-800">📚 Mata Kuliah yang Anda Ambil</h3>

                @if($krsData->isEmpty())
                <p class="text-gray-500 italic bg-gray-50 p-4 rounded text-center">Anda belum mengambil mata kuliah apapun.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-6 py-3">Mata Kuliah</th>
                                <th class="px-6 py-3">Dosen</th>
                                <th class="px-6 py-3">Jadwal</th>
                                <th class="px-6 py-3">SKS</th>

                                <!-- Kolom Baru -->
                                <th class="px-6 py-3 text-center">Nilai Akhir</th>
                                <th class="px-6 py-3 text-center">Grade</th>

                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($krsData as $krs)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $krs->jadwal->mataKuliah->nama_mk }} <br>
                                    <span class="text-xs text-gray-400">{{ $krs->jadwal->mataKuliah->kode_mk }}</span>
                                </td>
                                <td class="px-6 py-4">{{ $krs->jadwal->dosen->name }}</td>
                                <td class="px-6 py-4">
                                    {{ $krs->jadwal->hari }}, {{ $krs->jadwal->jam_mulai }} - {{ $krs->jadwal->jam_selesai }} <br>
                                    <span class="text-xs font-bold bg-gray-200 px-1 rounded">{{ $krs->jadwal->ruangan->nama_ruangan }}</span>
                                </td>
                                <td class="px-6 py-4">{{ $krs->jadwal->mataKuliah->sks }}</td>

                                <!-- Kolom Baru -->
                                <td class="px-6 py-4 text-center font-bold text-blue-600">
                                    {{ $krs->nilai_akhir ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-center font-bold">
                                    @if($krs->grade == 'A')
                                    <span class="text-green-600">A</span>
                                    @elseif($krs->grade == 'B')
                                    <span class="text-blue-600">B</span>
                                    @elseif($krs->grade == 'C')
                                    <span class="text-yellow-600">C</span>
                                    @elseif($krs->grade == 'D' || $krs->grade == 'E')
                                    <span class="text-red-600">{{ $krs->grade }}</span>
                                    @else
                                    -
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('mahasiswa.krs.destroy', $krs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan mata kuliah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-500 hover:bg-red-700 px-3 py-1 rounded text-xs font-bold transition">
                                            Hapus
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                <h3 class="text-lg font-bold mb-4 text-gray-800">✅ Jadwal Kuliah Tersedia</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-green-50">
                            <tr>
                                <th class="px-6 py-3">Mata Kuliah</th>
                                <th class="px-6 py-3">Dosen</th>
                                <th class="px-6 py-3">Jadwal & Ruang</th>
                                <th class="px-6 py-3">SKS</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allJadwals as $jadwal)
                            @php
                            $sudahDiambil = $krsData->contains('jadwal_kuliah_id', $jadwal->id);
                            @endphp

                            <tr class="bg-white border-b hover:bg-gray-50 {{ $sudahDiambil ? 'opacity-50 bg-gray-100' : '' }}">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $jadwal->mataKuliah->nama_mk }}
                                </td>
                                <td class="px-6 py-4">{{ $jadwal->dosen->name }}</td>
                                <td class="px-6 py-4">
                                    {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }} <br>
                                    <span class="text-xs bg-gray-200 px-1 rounded">{{ $jadwal->ruangan->nama_ruangan }}</span>
                                </td>
                                <td class="px-6 py-4">{{ $jadwal->mataKuliah->sks }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($sudahDiambil)
                                    <span class="text-xs font-bold text-gray-500 border border-gray-300 px-2 py-1 rounded">Sudah Diambil</span>
                                    @else
                                    <form action="{{ route('mahasiswa.krs.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="jadwal_kuliah_id" value="{{ $jadwal->id }}">
                                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-800 px-3 py-1 rounded text-xs font-bold transition shadow-md">
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
</x-app-layout>
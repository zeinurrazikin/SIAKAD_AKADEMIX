<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Input Nilai Mahasiswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">Pilih Kelas yang Anda Ajar:</h3>

                @if($jadwals->isEmpty())
                <p class="text-gray-500 italic">Anda belum memiliki jadwal mengajar.</p>
                @else
                <table class="w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-3 text-left">Mata Kuliah</th>
                            <th class="border p-3 text-left">Jadwal & Ruang</th>
                            <th class="border p-3 text-left">Semester</th>
                            <th class="border p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $j)
                        <tr>
                            <td class="border p-3">
                                <span class="font-bold">{{ $j->mataKuliah->nama_mk }}</span><br>
                                <span class="text-xs text-gray-500">{{ $j->mataKuliah->kode_mk }}</span>
                            </td>
                            <td class="border p-3">
                                {{ $j->hari }}, {{ $j->jam_mulai }} - {{ $j->jam_selesai }} <br>
                                <span class="bg-gray-200 px-2 rounded text-xs">{{ $j->ruangan->nama_ruangan }}</span>
                            </td>
                            <td class="border p-3">{{ $j->semester->nama_semester }}</td>
                            <td class="border p-3 text-center">
                                <a href="{{ route('dosen.nilai.show', $j->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-bold text-xs">
                                    Masuk Kelas &rarr;
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
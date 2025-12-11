<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Input Nilai: {{ $jadwal->mataKuliah->nama_mk }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('dosen.nilai.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali ke Daftar Kelas</a>

            @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4 font-bold">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-bold text-lg mb-2">Daftar Mahasiswa</h3>
                <p class="text-sm text-gray-500 mb-6">Silakan input nilai Tugas, UTS, dan UAS. Nilai Akhir & Grade akan dihitung otomatis.</p>

                @if($listMahasiswa->isEmpty())
                <p class="text-center text-red-500 py-4">Belum ada mahasiswa yang mengambil kelas ini.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 border">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 border">Nama Mahasiswa</th>
                                <th class="px-4 py-3 border w-24">Tugas (30%)</th>
                                <th class="px-4 py-3 border w-24">UTS (30%)</th>
                                <th class="px-4 py-3 border w-24">UAS (40%)</th>
                                <th class="px-4 py-3 border w-20">Akhir</th>
                                <th class="px-4 py-3 border w-16">Grade</th>
                                <th class="px-4 py-3 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listMahasiswa as $mhs)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900 border">
                                    {{ $mhs->mahasiswa->name }} <br>
                                    <span class="text-xs text-gray-400">{{ $mhs->mahasiswa->email }}</span>
                                </td>

                                <form action="{{ route('dosen.nilai.update', $mhs->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <td class="px-4 py-3 border">
                                        <input type="number" name="nilai_tugas" value="{{ $mhs->nilai_tugas }}" class="w-20 border rounded p-1 text-center" min="0" max="100" required>
                                    </td>
                                    <td class="px-4 py-3 border">
                                        <input type="number" name="nilai_uts" value="{{ $mhs->nilai_uts }}" class="w-20 border rounded p-1 text-center" min="0" max="100" required>
                                    </td>
                                    <td class="px-4 py-3 border">
                                        <input type="number" name="nilai_uas" value="{{ $mhs->nilai_uas }}" class="w-20 border rounded p-1 text-center" min="0" max="100" required>
                                    </td>

                                    <td class="px-4 py-3 border font-bold text-blue-600 text-center">
                                        {{ $mhs->nilai_akhir }}
                                    </td>
                                    <td class="px-4 py-3 border font-bold text-center">
                                        <span class="bg-gray-200 px-2 py-1 rounded">{{ $mhs->grade }}</span>
                                    </td>

                                    <td class="px-4 py-3 border text-center">
                                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-800 transition">
                                            Simpan
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kartu Hasil Studi (KHS)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Nama Mahasiswa</p>
                        <p class="font-bold text-lg">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Email / NIM</p>
                        <p class="font-bold text-lg">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            @if(empty($hasilStudi))
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded text-center">
                Belum ada nilai yang keluar. Silakan tunggu dosen menginput nilai.
            </div>
            @else
            @foreach($hasilStudi as $khs)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-8 border-t-4 border-blue-500">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">
                        📂 {{ $khs['semester_nama'] }}
                    </h3>
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold">
                        IPS: {{ $khs['ips'] }}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 border">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 border">Kode</th>
                                <th class="px-6 py-3 border">Mata Kuliah</th>
                                <th class="px-6 py-3 border">SKS</th>
                                <th class="px-6 py-3 border text-center">Nilai Angka</th>
                                <th class="px-6 py-3 border text-center">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($khs['data_matkul'] as $mk)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 border font-mono">{{ $mk->jadwal->mataKuliah->kode_mk }}</td>
                                <td class="px-6 py-4 border font-medium text-gray-900">
                                    {{ $mk->jadwal->mataKuliah->nama_mk }}
                                </td>
                                <td class="px-6 py-4 border">{{ $mk->jadwal->mataKuliah->sks }}</td>
                                <td class="px-6 py-4 border text-center">{{ $mk->nilai_akhir }}</td>
                                <td class="px-6 py-4 border text-center font-bold">
                                    @php
                                    $color = match($mk->grade) {
                                    'A' => 'text-green-600',
                                    'B' => 'text-blue-600',
                                    'C' => 'text-yellow-600',
                                    default => 'text-red-600',
                                    };
                                    @endphp
                                    <span class="{{ $color }}">{{ $mk->grade }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100 font-bold">
                            <tr>
                                <td colspan="2" class="px-6 py-3 text-right">Total SKS Semester Ini:</td>
                                <td class="px-6 py-3 border text-blue-800">{{ $khs['total_sks'] }}</td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            @endforeach
            @endif

        </div>
    </div>
</x-app-layout>
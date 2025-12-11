<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transkrip Nilai Akademik
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 mb-6 relative">

                <button onclick="window.print()" class="absolute top-8 right-8 bg-gray-800 text-white px-4 py-2 rounded text-sm hover:bg-gray-700 no-print">
                    🖨️ Cetak Transkrip
                </button>

                <div class="text-center mb-8 border-b pb-4">
                    <h1 class="text-2xl font-bold uppercase tracking-widest">Transkrip Nilai Sementara</h1>
                    <p class="text-gray-500">Universitas Laravel Indonesia</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <table class="text-sm">
                            <tr>
                                <td class="w-32 font-bold text-gray-600">Nama Lengkap</td>
                                <td class="px-2">:</td>
                                <td class="font-bold">{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold text-gray-600">NIM / Email</td>
                                <td class="px-2">:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Tanggal Cetak: {{ date('d F Y') }}</p>
                    </div>
                </div>

                @if($transkrip->isEmpty())
                <p class="text-center text-gray-500 italic py-8">Belum ada data akademik yang terekam.</p>
                @else
                <table class="w-full text-sm border-collapse border border-gray-400">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-400 px-4 py-2 text-center w-12">No</th>
                            <th class="border border-gray-400 px-4 py-2 text-left">Kode MK</th>
                            <th class="border border-gray-400 px-4 py-2 text-left">Mata Kuliah</th>
                            <th class="border border-gray-400 px-4 py-2 text-center">Semester</th>
                            <th class="border border-gray-400 px-4 py-2 text-center">SKS</th>
                            <th class="border border-gray-400 px-4 py-2 text-center">Nilai</th>
                            <th class="border border-gray-400 px-4 py-2 text-center">Mutu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($transkrip as $krs)
                        @php
                        $bobot = match($krs->grade) { 'A'=>4, 'B'=>3, 'C'=>2, 'D'=>1, default=>0 };
                        $mutu = $krs->jadwal->mataKuliah->sks * $bobot;
                        @endphp
                        <tr>
                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $no++ }}</td>
                            <td class="border border-gray-400 px-4 py-2 font-mono">{{ $krs->jadwal->mataKuliah->kode_mk }}</td>
                            <td class="border border-gray-400 px-4 py-2">{{ $krs->jadwal->mataKuliah->nama_mk }}</td>
                            <td class="border border-gray-400 px-4 py-2 text-center text-xs text-gray-500">
                                {{ $krs->jadwal->semester->nama_semester }}
                            </td>
                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $krs->jadwal->mataKuliah->sks }}</td>
                            <td class="border border-gray-400 px-4 py-2 text-center font-bold">{{ $krs->grade }}</td>
                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $mutu }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 font-bold">
                        <tr>
                            <td colspan="4" class="border border-gray-400 px-4 py-2 text-right">TOTAL</td>
                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $totalSks }}</td>
                            <td class="border border-gray-400 px-4 py-2 bg-gray-200"></td>
                            <td class="border border-gray-400 px-4 py-2 text-center">{{ $totalMutu }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-8 border-t pt-4 flex justify-end">
                    <table class="w-64">
                        <tr>
                            <td class="text-gray-600 font-bold">Total SKS</td>
                            <td class="text-right font-bold">{{ $totalSks }}</td>
                        </tr>
                        <tr>
                            <td class="text-gray-600 font-bold">Total Mutu</td>
                            <td class="text-right font-bold">{{ $totalMutu }}</td>
                        </tr>
                        <tr class="text-xl text-blue-800">
                            <td class="font-bold pt-2">IPK</td>
                            <td class="text-right font-bold pt-2">{{ $ipk }}</td>
                        </tr>
                    </table>
                </div>
                @endif
            </div>

        </div>
    </div>

    <style>
        @media print {

            .no-print,
            header,
            nav {
                display: none !important;
            }

            body {
                background: white;
            }

            .shadow-sm {
                box-shadow: none !important;
            }
        }
    </style>
</x-app-layout>
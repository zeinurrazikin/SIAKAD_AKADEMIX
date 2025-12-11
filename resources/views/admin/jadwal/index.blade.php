<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Jadwal Kuliah</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('admin.jadwal.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block font-bold">+ Buat Jadwal Baru</a>

                @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
                @endif

                <table class="w-full border mt-4 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Hari/Jam</th>
                            <th class="border p-2">Mata Kuliah</th>
                            <th class="border p-2">Dosen</th>
                            <th class="border p-2">Ruangan</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwals as $jadwal)
                        <tr>
                            <td class="border p-2">
                                <span class="font-bold">{{ $jadwal->hari }}</span><br>
                                {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                            </td>
                            <td class="border p-2">
                                {{ $jadwal->mataKuliah->nama_mk }} <br>
                                <span class="text-gray-500 text-xs">({{ $jadwal->mataKuliah->kode_mk }})</span>
                            </td>
                            <td class="border p-2">{{ $jadwal->dosen->name }}</td>
                            <td class="border p-2">{{ $jadwal->ruangan->nama_ruangan }}</td>
                            <td class="border p-2">
                                <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
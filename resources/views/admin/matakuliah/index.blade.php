<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Mata Kuliah</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('admin.matakuliah.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Mata Kuliah</a>

                @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
                @endif

                <table class="w-full border-collapse border border-gray-200 mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2 text-left">Kode</th>
                            <th class="border p-2 text-left">Nama MK</th>
                            <th class="border p-2 text-left">SKS</th>
                            <th class="border p-2 text-left">Smt</th>
                            <th class="border p-2 text-left">Prodi</th>
                            <th class="border p-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mataKuliahs as $mk)
                        <tr>
                            <td class="border p-2">{{ $mk->kode_mk }}</td>
                            <td class="border p-2">{{ $mk->nama_mk }}</td>
                            <td class="border p-2">{{ $mk->sks }}</td>
                            <td class="border p-2">{{ $mk->semester_paket }}</td>
                            <td class="border p-2">{{ $mk->prodi->nama_prodi }}</td>
                            <td class="border p-2">
                                <a href="{{ route('admin.matakuliah.edit', $mk) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('admin.matakuliah.destroy', $mk) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 ml-2">Hapus</button>
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
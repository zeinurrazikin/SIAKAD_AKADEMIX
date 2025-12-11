<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Semester</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('admin.semester.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Semester</a>

                @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
                @endif

                <table class="w-full border-collapse border border-gray-200 mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2 text-left">Nama Semester</th>
                            <th class="border p-2 text-left">Status</th>
                            <th class="border p-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($semesters as $s)
                        <tr>
                            <td class="border p-2">{{ $s->nama_semester }}</td>
                            <td class="border p-2">
                                @if($s->aktif)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Aktif</span>
                                @else
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2 py-1 rounded">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="border p-2">
                                <a href="{{ route('admin.semester.edit', $s->id) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('admin.semester.destroy', $s->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus semester ini?')">
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
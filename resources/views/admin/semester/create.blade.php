<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Semester</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.semester.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1 font-bold">Nama Semester</label>
                        <input type="text" name="nama_semester" placeholder="Contoh: Ganjil 2024/2025" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-bold">Status Semester</label>
                        <select name="aktif" class="w-full border rounded p-2">
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif (Sedang Berjalan)</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                    <a href="{{ route('admin.semester.index') }}" class="ml-2 text-gray-600">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
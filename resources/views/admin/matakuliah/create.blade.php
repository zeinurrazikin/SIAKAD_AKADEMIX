<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Mata Kuliah</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.matakuliah.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="kode_mk" class="block text-sm font-medium text-gray-700">Kode MK</label>
                        <input type="text" name="kode_mk" id="kode_mk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="nama_mk" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                        <input type="text" name="nama_mk" id="nama_mk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="sks" class="block text-sm font-medium text-gray-700">SKS</label>
                        <input type="number" name="sks" id="sks" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="semester_paket" class="block text-sm font-medium text-gray-700">Semester</label>
                        <input type="number" name="semester_paket" id="semester_paket" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <select name="prodi_id" id="prodi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Prodi --</option>
                            @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                        <a href="{{ route('admin.matakuliah.index') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                    </div>
                </form>

            </div>  
        </div>
    </div>
</x-app-layout>
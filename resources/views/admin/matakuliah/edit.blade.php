<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.matakuliah.update', $mataKuliah->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block mb-1 font-bold text-gray-700">Kode MK</label>
                        <input type="text" name="kode_mk" value="{{ $mataKuliah->kode_mk }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-bold text-gray-700">Nama Mata Kuliah</label>
                        <input type="text" name="nama_mk" value="{{ $mataKuliah->nama_mk }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>

                    <div class="flex gap-4">
                        <div class="mb-4 w-1/2">
                            <label class="block mb-1 font-bold text-gray-700">SKS</label>
                            <input type="number" name="sks" value="{{ $mataKuliah->sks }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div class="mb-4 w-1/2">
                            <label class="block mb-1 font-bold text-gray-700">Semester</label>
                            <input type="number" name="semester_paket" value="{{ $mataKuliah->semester_paket }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-bold text-gray-700">Program Studi</label>
                        <select name="prodi_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ $mataKuliah->prodi_id == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Data
                        </button>
                        <a href="{{ route('admin.matakuliah.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
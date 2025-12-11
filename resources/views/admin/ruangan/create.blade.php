<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Ruangan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.ruangan.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1 font-bold">Kode Ruangan</label>
                        <input type="text" name="kode_ruangan" placeholder="Contoh: R.101" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-bold">Nama Ruangan / Keterangan</label>
                        <input type="text" name="nama_ruangan" placeholder="Contoh: Lab Komputer 1" class="w-full border rounded p-2" required>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Ruangan</button>
                    <a href="{{ route('admin.ruangan.index') }}" class="ml-2 text-gray-600">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
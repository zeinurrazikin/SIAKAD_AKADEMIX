<x-app-layout>
    <!-- Header -->
    <div class="relative bg-gradient-to-r from-amber-800 via-yellow-800 to-amber-900 pb-24 overflow-hidden">
        <div class="absolute inset-0 opacity-40">
            <img class="absolute inset-0 -z-10 h-full w-full object-cover opacity-70"
                 src="https://poliwangi.ac.id/wp-content/uploads/2024/12/IMG_9667-scaled-1.jpg"
                 alt="Campus background">
            <div class="absolute inset-0 -z-20 bg-black/50"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-bold leading-8 text-white sm:text-4xl tracking-tight">
                    Tambah Mata Kuliah
                </h2>
                <p class="mt-3 text-yellow-100">
                    Buat entri mata kuliah baru untuk sistem Akademix.
                </p>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/30 overflow-hidden">
                <form action="{{ route('admin.matakuliah.store') }}" method="POST">
                    @csrf
                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="nama_mk" class="block text-sm font-semibold text-gray-700 mb-1">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" id="nama_mk" placeholder="Contoh: Pemrograman Web Lanjut" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                        </div>
                        <div>
                            <label for="kode_mk" class="block text-sm font-semibold text-gray-700 mb-1">Kode MK</label>
                            <input type="text" name="kode_mk" id="kode_mk" placeholder="Contoh: PWL201" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                        </div>

                        <div>
                            <label for="sks" class="block text-sm font-semibold text-gray-700 mb-1">Jumlah SKS</label>
                            <input type="number" name="sks" id="sks" placeholder="Contoh: 3" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                        </div>

                        <div class="md:col-span-2">
                            <label for="prodi_id" class="block text-sm font-semibold text-gray-700 mb-1">Program Studi</label>
                            <select name="prodi_id" id="prodi_id" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="semester_paket" class="block text-sm font-semibold text-gray-700 mb-1">Paket Semester</label>
                            <input type="number" name="semester_paket" id="semester_paket" placeholder="Contoh: 3" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                            <p class="mt-2 text-xs text-gray-500">Mata kuliah ini disarankan untuk diambil pada semester ke berapa.</p>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end items-center gap-4">
                        <a href="{{ route('admin.matakuliah.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Batal</a>
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            Simpan Mata Kuliah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
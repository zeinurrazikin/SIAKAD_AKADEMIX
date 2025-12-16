<x-app-layout>
    <!-- Header -->
    <div class="relative bg-gradient-to-r from-slate-800 via-stone-800 to-slate-900 pb-24 overflow-hidden">
        <div class="absolute inset-0 opacity-40">
            <img class="absolute inset-0 -z-10 h-full w-full object-cover opacity-70"
                 src="https://poliwangi.ac.id/wp-content/uploads/2024/12/IMG_9667-scaled-1.jpg"
                 alt="Campus background">
            <div class="absolute inset-0 -z-20 bg-black/50"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-bold leading-8 text-white sm:text-4xl tracking-tight">
                    Edit Semester
                </h2>
                <p class="mt-3 text-stone-100">
                    Perbarui data untuk semester: <span class="font-bold">{{ $semester->nama_semester }}</span>
                </p>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/30 overflow-hidden">
                <form action="{{ route('admin.semester.update', $semester->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-8 space-y-6">
                        <div>
                            <label for="nama_semester" class="block text-sm font-semibold text-gray-700 mb-1">Nama Semester</label>
                            <input type="text" name="nama_semester" id="nama_semester" value="{{ old('nama_semester', $semester->nama_semester) }}" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                        </div>

                        <div>
                            <label for="aktif" class="block text-sm font-semibold text-gray-700 mb-1">Status Semester</label>
                            <select name="aktif" id="aktif" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                <option value="0" @selected(old('aktif', $semester->aktif) == 0)>Tidak Aktif</option>
                                <option value="1" @selected(old('aktif', $semester->aktif) == 1)>Aktif (Sedang Berjalan)</option>
                            </select>
                            <p class="mt-2 text-xs text-gray-500">Hanya boleh ada satu semester yang aktif dalam satu waktu.</p>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end items-center gap-4">
                        <a href="{{ route('admin.semester.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Batal</a>
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            Update Semester
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
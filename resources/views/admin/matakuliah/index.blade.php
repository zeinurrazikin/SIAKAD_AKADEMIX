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
                    Manajemen Mata Kuliah
                </h2>
                <p class="mt-3 text-yellow-100">
                    Kelola daftar mata kuliah yang ditawarkan di setiap program studi.
                </p>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-md bg-white/90 backdrop-blur-sm px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 border border-white/30 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Dashboard
                </a>
                <a href="{{ route('admin.matakuliah.create') }}" class="inline-flex items-center gap-2 rounded-md bg-indigo-600/90 backdrop-blur-sm px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 border border-indigo-500/50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Mata Kuliah
                </a>
            </div>
            
            @if(session('success'))
            <div class="rounded-md bg-green-50 p-4 mb-6 shadow-sm border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/30 overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="w-full text-sm">
                            <thead class="text-left text-xs uppercase tracking-wider text-gray-600 bg-gray-100">
                                <tr>
                                    <th class="p-4 font-bold">Kode MK</th>
                                    <th class="p-4 font-bold">Nama Mata Kuliah</th>
                                    <th class="p-4 font-bold text-center">SKS</th>
                                    <th class="p-4 font-bold text-center">Semester</th>
                                    <th class="p-4 font-bold">Program Studi</th>
                                    <th class="p-4 font-bold text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($mataKuliahs as $mk)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 font-mono text-gray-800">{{ $mk->kode_mk }}</td>
                                    <td class="p-4 font-semibold text-gray-800">{{ $mk->nama_mk }}</td>
                                    <td class="p-4 text-center font-bold text-gray-600">{{ $mk->sks }}</td>
                                    <td class="p-4 text-center text-gray-600">{{ $mk->semester_paket }}</td>
                                    <td class="p-4 text-gray-600">{{ $mk->prodi->nama_prodi }}</td>
                                    <td class="p-4 text-right space-x-2">
                                        <a href="{{ route('admin.matakuliah.edit', $mk) }}" class="text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded text-xs font-bold transition">Edit</a>
                                        <form action="{{ route('admin.matakuliah.destroy', $mk) }}" method="POST" class="inline" onsubmit="return confirm('Anda yakin ingin menghapus mata kuliah ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-xs font-bold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-8 text-gray-500">
                                        Belum ada data mata kuliah.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
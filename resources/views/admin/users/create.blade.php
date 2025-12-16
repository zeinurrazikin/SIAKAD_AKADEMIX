<x-app-layout>
    <!-- Header -->
    <div class="relative bg-gradient-to-r from-rose-800 via-pink-800 to-rose-900 pb-24 overflow-hidden">
        <div class="absolute inset-0 opacity-40">
            <img class="absolute inset-0 -z-10 h-full w-full object-cover opacity-70"
                 src="https://poliwangi.ac.id/wp-content/uploads/2024/12/IMG_9667-scaled-1.jpg"
                 alt="Campus background">
            <div class="absolute inset-0 -z-20 bg-black/50"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-bold leading-8 text-white sm:text-4xl tracking-tight">
                    Tambah Pengguna Baru
                </h2>
                <p class="mt-3 text-pink-100">
                    Buat akun baru untuk mahasiswa, dosen, atau admin.
                </p>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/30 overflow-hidden">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name" placeholder="Contoh: John Doe" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" placeholder="Contoh: john.doe@example.com" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                            </div>
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">Role (Hak Akses)</label>
                            <select name="role" id="role" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                                <input type="password" name="password" id="password" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end items-center gap-4">
                        <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Batal</a>
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
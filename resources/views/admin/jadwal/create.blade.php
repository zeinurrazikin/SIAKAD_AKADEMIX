<x-app-layout>
    <!-- Header -->
    <div class="relative bg-gradient-to-r from-blue-800 via-sky-800 to-blue-900 pb-24 overflow-hidden">
        <div class="absolute inset-0 opacity-40">
            <img class="absolute inset-0 -z-10 h-full w-full object-cover opacity-70"
                 src="https://poliwangi.ac.id/wp-content/uploads/2024/12/IMG_9667-scaled-1.jpg"
                 alt="Campus background">
            <div class="absolute inset-0 -z-20 bg-black/50"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h2 class="text-3xl font-bold leading-8 text-white sm:text-4xl tracking-tight">
                    Buat Jadwal Baru
                </h2>
                <p class="mt-3 text-sky-100">
                    Buat entri jadwal perkuliahan baru untuk sistem Akademix.
                </p>
            </div>
        </div>
    </div>

    <main class="-mt-24 pb-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-white/30 overflow-hidden">
                <form action="{{ route('admin.jadwal.store') }}" method="POST">
                    @csrf
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="mata_kuliah_id" class="block text-sm font-semibold text-gray-700 mb-1">Mata Kuliah</label>
                                <select name="mata_kuliah_id" id="mata_kuliah_id" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    @foreach($mataKuliahs as $mk)
                                    <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="dosen_id" class="block text-sm font-semibold text-gray-700 mb-1">Dosen Pengajar</label>
                                <select name="dosen_id" id="dosen_id" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="ruangan_id" class="block text-sm font-semibold text-gray-700 mb-1">Ruangan</label>
                                <select name="ruangan_id" id="ruangan_id" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach($ruangans as $r)
                                    <option value="{{ $r->id }}">{{ $r->kode_ruangan }} - {{ $r->nama_ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="semester_id" class="block text-sm font-semibold text-gray-700 mb-1">Semester Aktif</label>
                                <select name="semester_id" id="semester_id" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                                    <option value="">-- Pilih Semester --</option>
                                    @foreach($semesters as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama_semester }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="hari" class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                                <select name="hari" id="hari" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                            <div>
                                <label for="jam_mulai" class="block text-sm font-semibold text-gray-700 mb-1">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                            </div>
                            <div>
                                <label for="jam_selesai" class="block text-sm font-semibold text-gray-700 mb-1">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                            </div>
                        </div>

                        <div>
                            <label for="kuota" class="block text-sm font-semibold text-gray-700 mb-1">Kuota Mahasiswa</label>
                            <input type="number" name="kuota" id="kuota" value="30" class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" required>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end items-center gap-4">
                        <a href="{{ route('admin.jadwal.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-800">Batal</a>
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>
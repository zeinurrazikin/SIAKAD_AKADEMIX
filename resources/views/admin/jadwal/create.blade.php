<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Buat Jadwal Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.jadwal.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-bold mb-1">Mata Kuliah</label>
                        <select name="mata_kuliah_id" class="w-full border rounded p-2" required>
                            <option value="">-- Pilih MK --</option>
                            @foreach($mataKuliahs as $mk)
                            <option value="{{ $mk->id }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }} ({{ $mk->sks }} SKS)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-1">Dosen Pengajar</label>
                        <select name="dosen_id" class="w-full border rounded p-2" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <div class="mb-4 w-1/2">
                            <label class="block font-bold mb-1">Ruangan</label>
                            <select name="ruangan_id" class="w-full border rounded p-2" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($ruangans as $r)
                                <option value="{{ $r->id }}">{{ $r->kode_ruangan }} - {{ $r->nama_ruangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 w-1/2">
                            <label class="block font-bold mb-1">Semester</label>
                            <select name="semester_id" class="w-full border rounded p-2" required>
                                <option value="">-- Pilih Semester --</option>
                                @foreach($semesters as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_semester }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="mb-4 w-1/3">
                            <label class="block font-bold mb-1">Hari</label>
                            <select name="hari" class="w-full border rounded p-2" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>
                        <div class="mb-4 w-1/3">
                            <label class="block font-bold mb-1">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="w-full border rounded p-2" required>
                        </div>
                        <div class="mb-4 w-1/3">
                            <label class="block font-bold mb-1">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="w-full border rounded p-2" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-1">Kuota Mahasiswa</label>
                        <input type="number" name="kuota" value="30" class="w-full border rounded p-2" required>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold">Simpan Jadwal</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
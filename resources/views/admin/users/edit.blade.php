<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>  

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                        <select name="role" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="dosen" {{ $user->role == 'dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                        Update User
                    </button>
                    </>

            </div>
        </div>
    </div>
</x-app-layout>
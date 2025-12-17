<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 -z-10">
            <img 
                class="absolute inset-0 w-full h-full object-cover" 
                src="https://poliwangi.ac.id/wp-content/uploads/2024/12/IMG_9667-scaled-1.jpg" 
                alt="Background Kampus">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/80 to-slate-900/70"></div>
            
        </div>

        <!-- Main Content -->
        <div class="max-w-md w-full space-y-8">

            <div class="text-center relative">
                <h2 class="mt-6 text-3xl font-extrabold text-white tracking-tight relative">
                    <span class="relative z-10">AkademiX</span>
                </h2>
                <p class="mt-2 text-sm text-indigo-200">
                    Sistem Informasi Akademik Terpadu
                </p>
            </div>

            <!-- Login Card -->
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/30 transform transition duration-500 hover:scale-[1.02]">
                <!-- Welcome Message -->
                <div class="text-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">Selamat Datang</h3>
                    <p class="text-sm text-gray-500 mt-1">Masukkan Akun Anda untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div class="relative">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                value="{{ old('email') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 bg-white/80"
                                placeholder="nama@siakad.com"
                            >
                        </div>
                        @error('email')
                            <span class="text-red-600 text-sm">
                                @if($message === 'auth.failed' || $message === 'These credentials do not match our records.')
                                    Login gagal, pastikan email dan password sesuai!
                                @else
                                    {{ $message }}
                                @endif
                            </span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 bg-white/80"
                                placeholder="••••••••"
                            >
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember_me"
                                name="remember"
                                type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                            >
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                Ingat saya
                            </label>
                        </div>
                        
                    </div>

                    <!-- Submit Button -->
                    <div class="relative">
                        <button
                            type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-xl relative overflow-hidden"
                        >
                            <span class="relative z-10">Masuk ke Akun</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-700 to-indigo-800 opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>
                </form>

                <!-- Footer -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <!-- <div class="flex justify-center space-x-6">
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Aman
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="h-4 w-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Cepat
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="h-4 w-4 mr-1 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Terpercaya
                        </div>
                    </div> -->
                    <div class="mt-4 text-center">
                        <p class="text-xs text-gray-500">
                            © {{ date('Y') }} Akademix. Hak Cipta Dilindungi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
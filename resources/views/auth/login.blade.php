<x-guest-layout>
    {{-- Main Container: Full Height with Background --}}
    <div class="relative min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 isolate overflow-hidden bg-gray-900">
        
        {{-- 1. Background Image & Overlay --}}
        <img class="absolute inset-0 -z-10 h-full w-full object-cover opacity-40" 
             src="https://poliwangi.ac.id/wp-content/uploads/2024/12/IMG_9667-scaled-1.jpg" 
             alt="Background Kampus">
        
        {{-- Gradient Overlay untuk Readability --}}
        <div class="absolute inset-0 -z-10 bg-gradient-to-br from-indigo-900/90 via-blue-900/80 to-gray-900/90 mix-blend-multiply"></div>

        {{-- 2. Header / Logo Section --}}
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center z-10 relative">
            <div class="mx-auto h-16 w-16 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md ring-1 ring-white/20 mb-6 shadow-lg">
                <svg class="h-9 w-9 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            
            <h2 class="text-3xl font-bold tracking-tight text-white drop-shadow-sm">
                Akademi<span class="text-indigo-300">X</span>
            </h2>
            <p class="mt-2 text-sm text-indigo-100/80">
                Sistem Informasi Akademik Terpadu
            </p>
        </div>

        {{-- 3. Login Card Section --}}
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[480px] z-10 relative px-4 sm:px-0">
            <div class="bg-white/95 backdrop-blur-sm px-6 py-10 shadow-2xl sm:rounded-2xl sm:px-12 border border-white/50">
                
                <div class="mb-8 text-center">
                    <h3 class="text-xl font-bold text-gray-900">Selamat Datang</h3>
                    <p class="text-sm text-gray-500 mt-1">Silakan masukkan akun akademik Anda.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- Email Input --}}
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email / Username</label>
                        <div class="relative mt-2 rounded-md shadow-sm group">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-600 transition-colors" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                    <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="text" autocomplete="email" required 
                                value="{{ old('email') }}"
                                class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all" 
                                placeholder="NIM / NIDN / Email">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password Input --}}
                    <div>
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="relative mt-2 rounded-md shadow-sm group">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-600 transition-colors" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all" 
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember Me & Forgot Password --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 cursor-pointer">
                            <label for="remember_me" class="ml-2 block text-sm leading-6 text-gray-900 cursor-pointer select-none">Ingat saya</label>
                        </div>

                        <div class="text-sm leading-6">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 hover:underline">Lupa password?</a>
                            @endif
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 hover:shadow-md focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200 transform hover:scale-[1.01]">
                            Masuk Portal
                        </button>
                    </div>
                </form>

                {{-- Footer Area --}}
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm font-medium leading-6">
                            <span class="bg-white px-4 text-gray-500">Butuh Bantuan?</span>
                        </div>
                    </div>

                    <div class="mt-4 text-center text-xs text-gray-400 leading-relaxed">
                        Hubungi <strong>BAAK</strong> jika mengalami kendala login.<br>
                        &copy; {{ date('Y') }} AkademiX System. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
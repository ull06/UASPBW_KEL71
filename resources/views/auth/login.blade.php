<x-guest-layout>
    {{-- Kita hapus logo bagian atas luar karena sudah ada logo bawaan dari <x-guest-layout> --}}

    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm space-y-6">
        
        <!-- Judul Form Masuk -->
        <div class="text-center pb-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 tracking-tight">Masuk ke Akun</h2>
            <p class="text-xs text-gray-400 mt-1">Silakan masukkan email dan password Anda untuk mengakses ShareBite</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-semibold text-gray-700 mb-1 block" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50/50" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@panti.com atau donor@gmail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <div class="flex justify-between items-center mb-1">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="text-xs font-semibold text-gray-700 block" />
                    @if (Route::has('password.request'))
                        <a class="text-xs font-medium text-green-600 hover:text-green-700 transition" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50/50" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 focus:ring-green-500 h-4 w-4" name="remember">
                    <span class="ms-2 text-xs font-medium text-gray-600 select-none">{{ __('Ingat akun saya di perangkat ini') }}</span>
                </label>
            </div>

            <!-- Tombol Log In -->
            <!-- Tombol Log In -->
            <div class="pt-4">
                <x-primary-button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm flex justify-center items-center normal-case tracking-normal">
                    {{ __('Masuk Sekarang') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Link Daftar Akun Baru -->
        <div class="text-center pt-3 border-t border-gray-100 text-xs">
            <span class="text-gray-500">Belum punya akun kelompok/panti?</span>
            <a href="{{ route('register') }}" class="font-bold text-green-600 hover:text-green-700 transition ml-1">Daftar Akun</a>
        </div>
    </div>
</x-guest-layout>
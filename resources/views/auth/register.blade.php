<x-guest-layout>
    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm space-y-5">
        
        <!-- Judul Form Daftar -->
        <div class="text-center pb-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-900 tracking-tight">Daftar Akun Baru</h2>
            <p class="text-xs text-gray-400 mt-1">Bergabung bersama ShareBite untuk mulai berbagi atau menerima makanan</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-semibold text-gray-700 mb-1 block" />
                <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50/50" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-semibold text-gray-700 mb-1 block" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50/50" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@gmail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-xs font-semibold text-gray-700 mb-1 block" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50/50" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-xs font-semibold text-gray-700 mb-1 block" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50/50" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi Anda" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
            </div>

            <!-- Daftar Sebagai (Role/Peran) -->
            <div>
                <x-input-label for="role" :value="__('Daftar Sebagai')" class="text-xs font-semibold text-gray-700 mb-1 block" />
                <select id="role" name="role" required class="block mt-1 w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-green-500 focus:ring-green-500 bg-gray-50/50 text-gray-700">
                    <option value="" disabled selected>-- Pilih Peran Anda --</option>
                    <option value="donor">Donor (Penyedia Makanan)</option>
                    <option value="receiver">Receiver (Penerima Makanan/Panti)</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2 text-xs" />
            </div>
            <!-- Tombol Register -->
            <div class="pt-4">
                <x-primary-button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-sm flex justify-center items-center normal-case tracking-normal">
                    {{ __('Daftar Sekarang') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Link ke Halaman Login -->
        <div class="text-center pt-3 border-t border-gray-100 text-xs">
            <span class="text-gray-500">Sudah punya akun ShareBite?</span>
            <a href="{{ route('login') }}" class="font-bold text-green-600 hover:text-green-700 transition ml-1">Masuk di sini</a>
        </div>
    </div>
</x-guest-layout>
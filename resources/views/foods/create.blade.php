<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('foods.index') }}"
               class="text-gray-500 hover:text-gray-700 text-sm">
                ← Kembali
            </a>

            <span class="text-gray-300">|</span>

            <h2 class="font-bold text-xl text-gray-800">
                Tambah <span class="text-green-600">Makanan</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-xl p-8">

                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Informasi Makanan
                </h1>

                <p class="text-gray-500 text-sm mb-8">
                    Lengkapi data makanan yang ingin didonasikan.
                </p>

                {{-- Error Validation --}}
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('foods.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    {{-- Nama Makanan --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Makanan <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama_makanan"
                            value="{{ old('nama_makanan') }}"
                            required
                            placeholder="Contoh: Nasi Kotak, Roti Tawar"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="4"
                            placeholder="Jelaskan isi makanan, kondisi makanan, dan informasi lainnya..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('deskripsi') }}</textarea>
                    </div>

                    {{-- Jumlah & Lokasi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah (Porsi) <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                name="jumlah"
                                min="1"
                                value="{{ old('jumlah') }}"
                                required
                                placeholder="Masukkan jumlah porsi"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="lokasi"
                                value="{{ old('lokasi') }}"
                                required
                                placeholder="Contoh: Banda Aceh"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>

                    </div>

                    {{-- Expired --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Expired
                        </label>

                        <input
                            type="datetime-local"
                            name="expired_at"
                            value="{{ old('expired_at') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Makanan
                        </label>

                        <input
                            type="file"
                            name="gambar"
                            accept="image/*"
                            class="block w-full text-sm text-gray-500
                                   file:mr-4
                                   file:py-2
                                   file:px-4
                                   file:rounded-lg
                                   file:border-0
                                   file:bg-green-50
                                   file:text-green-700
                                   hover:file:bg-green-100">
                    </div>

                    {{-- Tombol --}}
                    <div class="flex flex-col sm:flex-row gap-3">

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition">
                            Simpan Makanan
                        </button>

                        <a
                            href="{{ route('foods.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium text-center transition">
                            Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('foods.index') }}"
               class="text-gray-500 hover:text-gray-700 text-sm">
                ← Kembali
            </a>

```
        <span class="text-gray-300">|</span>

        <h2 class="font-bold text-xl text-gray-800">
            Edit <span class="text-green-600">Makanan</span>
        </h2>
    </div>
</x-slot>

<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow-sm rounded-xl p-8">

            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Edit Informasi Makanan
            </h1>

            <p class="text-gray-500 text-sm mb-8">
                Perbarui data makanan yang ingin didonasikan.
            </p>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('foods.update', $food->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Nama Makanan --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Makanan <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama_makanan"
                        value="{{ old('nama_makanan', $food->nama_makanan) }}"
                        required
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
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ old('deskripsi', $food->deskripsi) }}</textarea>
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
                            value="{{ old('jumlah', $food->jumlah) }}"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi', $food->lokasi) }}"
                            required
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
                        value="{{ old('expired_at', $food->expired_at ? \Carbon\Carbon::parse($food->expired_at)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                {{-- Foto Saat Ini --}}
                @if($food->gambar)
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Saat Ini
                        </label>

                        @if(str_starts_with($food->gambar, 'images/'))
                            <img
                                src="{{ asset($food->gambar) }}"
                                alt="{{ $food->nama_makanan }}"
                                class="w-28 h-28 object-cover rounded-xl border border-green-200">
                        @else
                            <img
                                src="{{ asset('storage/' . $food->gambar) }}"
                                alt="{{ $food->nama_makanan }}"
                                class="w-28 h-28 object-cover rounded-xl border border-green-200">
                        @endif
                    </div>
                @endif

                {{-- Upload Foto Baru --}}
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $food->gambar ? 'Ganti Foto (Opsional)' : 'Foto Makanan' }}
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
                        Update Makanan
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
```

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">
                Donasi <span class="text-green-600">Makanan</span>
            </h2>

```
        <a href="{{ route('foods.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-full font-medium transition">
            + Tambah Makanan
        </a>
    </div>
</x-slot>

<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                ✓ {{ session('success') }}
            </div>
        @endif

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-sm text-gray-500 mb-2">
                    Total Makanan
                </p>

                <h3 class="text-3xl font-bold text-gray-800">
                    {{ $totalFoods }}
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-sm text-gray-500 mb-2">
                    Tersedia
                </p>

                <h3 class="text-3xl font-bold text-green-600">
                    {{ $tersedia }}
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <p class="text-sm text-gray-500 mb-2">
                    Habis
                </p>

                <h3 class="text-3xl font-bold text-red-500">
                    {{ $habis }}
                </h3>
            </div>

        </div>

        {{-- Grid Makanan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($foods as $food)

                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition duration-200">

                    {{-- Gambar --}}
                    @if($food->gambar)

                        @if(str_starts_with($food->gambar, 'images/'))
                            <img
                                src="{{ asset($food->gambar) }}"
                                alt="{{ $food->nama_makanan }}"
                                class="w-full h-48 object-cover">
                        @else
                            <img
                                src="{{ asset('storage/' . $food->gambar) }}"
                                alt="{{ $food->nama_makanan }}"
                                class="w-full h-48 object-cover">
                        @endif

                    @else

                        <div class="w-full h-48 bg-green-50 flex flex-col items-center justify-center text-gray-400">
                            <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>

                            <span class="mt-2 text-sm">
                                Tidak ada gambar
                            </span>
                        </div>

                    @endif

                    {{-- Body --}}
                    <div class="p-5">

                        <h3 class="font-bold text-lg text-gray-800">
                            {{ $food->nama_makanan }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">
                            {{ $food->deskripsi ?? '-' }}
                        </p>

                        <div class="mt-4 space-y-1 text-sm text-gray-600">
                            <p>📍 {{ $food->lokasi }}</p>
                            <p>📦 {{ $food->jumlah }} porsi</p>

                            <p>
                                ⏰
                                {{ $food->expired_at ? \Carbon\Carbon::parse($food->expired_at)->format('d M Y, H:i') : '-' }}
                            </p>
                        </div>

                        {{-- Status --}}
                        @if($food->status == 'tersedia')
                            <span class="inline-block mt-4 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                Tersedia
                            </span>
                        @else
                            <span class="inline-block mt-4 px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                {{ ucfirst($food->status) }}
                            </span>
                        @endif

                        {{-- Tombol --}}
                        <div class="flex gap-2 mt-5 pt-4 border-t">

                            <a href="{{ route('foods.edit', $food->id) }}"
                               class="flex-1 text-center border border-green-600 text-green-600 py-2 rounded-lg hover:bg-green-600 hover:text-white transition">
                                Edit
                            </a>

                            <form action="{{ route('foods.destroy', $food->id) }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-full border border-red-300 text-red-500 py-2 rounded-lg hover:bg-red-50 transition">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center py-20">

                    <svg width="52" height="52" fill="none" viewBox="0 0 24 24" stroke="#d1d5db" stroke-width="1" class="mx-auto mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>

                    <p class="text-gray-500 mb-4">
                        Belum ada makanan yang ditambahkan.
                    </p>

                    <a href="{{ route('foods.create') }}"
                       class="text-green-600 font-semibold hover:text-green-700">
                        + Tambah sekarang
                    </a>

                </div>

            @endforelse

        </div>

    </div>
</div>
```

</x-app-layout>

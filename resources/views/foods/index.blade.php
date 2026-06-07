<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🍱 Daftar Makanan Donor
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">
        <!-- STATISTIK DASHBOARD -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- TOTAL -->
            <div class="bg-gray-50 border border-gray-200 p-4 rounded-lg shadow-sm">
                <h3 class="text-sm">Total Makanan</h3>
                <p class="text-2xl font-bold">{{ $totalFoods }}</p>
            </div>

            <!-- TERSEDIA -->
            <div class="bg-gray-50 border border-gray-200 p-4 rounded-lg shadow-sm">
                <h3 class="text-sm">Tersedia</h3>
                <p class="text-2xl font-bold">{{ $tersedia }}</p>
            </div>

            <!-- HABIS -->
            <div class="bg-gray-50 border border-gray-200 p-4 rounded-lg shadow-sm">
                <h3 class="text-sm">Habis</h3>
                <p class="text-2xl font-bold">{{ $habis }}</p>
            </div>
        </div>

        <!-- BUTTON TAMBAH -->
        <div class="mb-6">
            <a href="{{ route('foods.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                + Tambah Makanan
            </a>
        </div>

        <!-- GRID CARD -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($foods as $food)

                <!-- CARD -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">

                    <!-- GAMBAR (BAGIAN YANG DI-UPDATE BIAR OTOMATIS) -->
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center border-b border-gray-100 relative overflow-hidden">
                        @if($food->gambar)
                            @if(str_starts_with($food->gambar, 'images/'))
                                {{-- 1. Ambil dari folder public/images (Untuk Seeder) --}}
                                <img src="{{ asset($food->gambar) }}" alt="{{ $food->nama_makanan }}" class="w-full h-full object-cover">
                            @else
                                {{-- 2. Ambil dari folder storage (Untuk Hasil Upload Web) --}}
                                <img src="{{ asset('storage/' . $food->gambar) }}" alt="{{ $food->nama_makanan }}" class="w-full h-full object-cover">
                            @endif
                        @else
                            {{-- 3. Jika tidak ada gambar sama sekali --}}
                            <div class="text-center text-gray-400 p-4">
                                <svg class="mx-auto h-8 w-8 text-gray-300 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">

                        <!-- NAMA MAKANAN -->
                        <h3 class="text-lg font-bold text-gray-800">
                            {{ $food->nama_makanan }}
                        </h3>

                        <!-- DESKRIPSI -->
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $food->deskripsi }}
                        </p>

                        <!-- INFO -->
                        <div class="mt-3 text-sm text-gray-700 space-y-1">
                            <p>📍 Lokasi: {{ $food->lokasi }}</p>
                            <p>📦 Jumlah: {{ $food->jumlah }}</p>
                            <p>⏰ Expired: {{ $food->expired_at }}</p>
                        </div>

                        <!-- STATUS -->
                        <div class="mt-3">
                            @if($food->status == 'tersedia')
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">
                                    Tersedia
                                </span>
                            @else
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs">
                                    Habis
                                </span>
                            @endif
                        </div>

                        <!-- ACTION -->
                        <div class="mt-4 flex gap-2">
                            <!-- EDIT BUTTON (SOFT) -->
                            <a href="{{ route('foods.edit', $food->id) }}"
                               class="px-3 py-1 text-sm rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                                Edit
                            </a>

                            <!-- DELETE BUTTON (SOFT RED) -->
                            <form action="{{ route('foods.destroy', $food->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus makanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 text-sm rounded-md border border-red-200 text-red-600 hover:bg-red-50 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            @empty

                <!-- JIKA DATA KOSONG -->
                <div class="col-span-3 text-center text-gray-500 py-12">
                    Belum ada makanan yang ditambahkan
                </div>

            @endforelse

        </div>
    </div>
</x-app-layout>
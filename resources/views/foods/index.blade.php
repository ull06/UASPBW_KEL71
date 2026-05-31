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

                    <!-- GAMBAR -->
                    @if($food->gambar)
                        <img src="{{ asset('storage/' . $food->gambar) }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            Tidak ada gambar
                        </div>
                    @endif

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
                <div class="col-span-3 text-center text-gray-500">
                    Belum ada makanan yang ditambahkan
                </div>

            @endforelse

        </div>

    </div>
</x-app-layout>
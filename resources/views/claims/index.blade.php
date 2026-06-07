<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Receiver
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h1 class="text-3xl font-bold text-gray-800">
                        Daftar Makanan Tersedia
                    </h1>
                    {{-- TOMBOL NAVIGASI KE HALAMAN RIWAYAT KLAIM --}}
                    <a href="{{ route('claims.history') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium shadow inline-block">
                        Lihat Riwayat Klaim →
                    </a>
                </div>

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Pesan error --}}
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4 border border-red-200">
                        {{ session('error') }}
                    </div>
                @endif

            <!-- Pencarian -->
            <form method="GET"
                action="{{ route('claims.index') }}"
                class="mb-8 flex flex-wrap gap-2">

                {{-- Cari nama makanan --}}
                <input type="text" 
                    name="cari" 
                    value="{{ $cari ?? '' }}" 
                    placeholder="Cari makanan..." 
                    class="border border-gray-300 rounded px-4 py-2 w-64 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">

                {{-- Cari lokasi --}}
                <input type="text" 
                    name="lokasi" 
                    value="{{ $lokasi ?? '' }}" 
                    placeholder="Cari lokasi terdekat..." 
                    class="border border-gray-300 rounded px-4 py-2 w-64 focus:border-green-500 focus:ring-1 focus:ring-green-500">

                {{-- Tombol cari --}}
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded transition font-medium shadow-sm">

                    Cari

                </button>

                {{-- Tombol reset --}}
                @if(($cari ?? false) || ($lokasi ?? false))

                    <a href="{{ route('claims.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded flex items-center transition text-sm font-medium">

                        Reset

                    </a>

                @endif

            </form>

                {{-- LIST MAKANAN --}}
                @forelse ($foods as $food)
                    <div class="border border-gray-200 rounded-xl p-6 mb-6 shadow-sm hover:shadow transition bg-white">
                    
                       {{-- LOGIKA BARU: WADAH GAMBAR DINAMIS (PUBLIC & STORAGE) --}}
                        <div class="mb-4 w-full h-48 bg-gray-50 rounded-lg overflow-hidden flex items-center justify-center border border-gray-100 relative">
                            @if($food->gambar)
                                @if(str_starts_with($food->gambar, 'images/'))
                                    {{-- Jika gambar bawaan dari folder public/images --}}
                                    <img src="{{ asset($food->gambar) }}" alt="{{ $food->nama_makanan }}" class="w-full h-full object-cover">
                                @else
                                    {{-- Jika gambar hasil upload dari web (storage) --}}
                                    <img src="{{ asset('storage/' . $food->gambar) }}" alt="{{ $food->nama_makanan }}" class="w-full h-full object-cover">
                                @endif
                            @else
                                {{-- Jika tidak ada foto sama sekali --}}
                                <div class="text-center text-gray-400 p-4">
                                    <svg class="mx-auto h-8 w-8 text-gray-300 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-xs">Tidak Ada Foto</span>
                                </div>
                            @endif
                        </div>

                        <h2 class="text-2xl font-bold text-gray-800">
                            {{ $food->nama_makanan }}
                        </h2>

                        <p class="mt-2 text-gray-600 leading-relaxed">
                            {{ $food->deskripsi }}
                        </p>

                        {{-- Detail Informasi Makanan --}}
                        <div class="mt-4 space-y-1.5 text-sm text-gray-600 border-b border-gray-100 pb-4">
                            <p><strong>Jumlah:</strong> <span class="text-gray-800 font-medium">{{ $food->jumlah }} Porsi</span></p>
                            <p><strong>Lokasi:</strong> <span class="text-gray-800 font-medium">{{ $food->lokasi }}</span></p>
                            <p><strong>Expired:</strong> <span class="text-red-600 font-medium">{{ $food->expired_at }}</span></p>
                            <p>

                             @php
                                $statusClass = '';

                                if ($food->status == 'tersedia') {
                                    $statusClass = 'bg-green-100 text-green-800';
                                } elseif ($food->status == 'diklaim') {
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                } elseif ($food->status == 'habis') {
                                    $statusClass = 'bg-red-100 text-red-800';
                                }
                            @endphp

                                <p>
                                <strong>Status:</strong>

                                <span class="{{ $statusClass }} text-xs font-semibold px-2.5 py-0.5 rounded-full uppercase ml-1">
                                    {{ $food->status }}
                                </span>
                            </p>

                        </div>

                        {{-- AREA AKSI --}}
                        <div class="mt-4 flex flex-wrap items-center gap-4">
                            
                            {{-- Tombol Detail --}}
                            <a href="{{ route('claims.show', $food->id) }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition font-medium shadow-sm">
                                Detail
                            </a>

                            {{-- FORM CLAIM --}}
                            <form method="POST" action="{{ route('claims.store') }}" class="flex gap-3 items-center m-0">
                                @csrf

                                <input type="hidden" name="food_id" value="{{ $food->id }}">

                                <input type="number" 
                                       name="jumlah" 
                                       min="1" 
                                       max="{{ $food->jumlah }}" 
                                       required 
                                       placeholder="Jumlah porsi" 
                                       class="border border-gray-300 rounded-lg px-3 py-2 w-40 text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500">

                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg text-sm transition font-semibold shadow-sm whitespace-nowrap">
                                    Klaim
                                </button>
                            </form>

                        </div>

                    </div>
                @empty
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-4 rounded-lg">
                        Tidak ada makanan tersedia.
                    </div>
                @endforelse

            </div>
        </div>
    </div>

</x-app-layout>
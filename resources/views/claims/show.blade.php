<style>
    /* 1. Mengubah background header navigasi utama tempat logo menjadi Hijau Emerald */
    nav.bg-white {
        background-color: #047857 !important; /* Hijau Emerald ShareBite */
        border-bottom: 1px solid #065f46 !important;
    }

    /* 2. Mengubah semua teks menu navigasi atas menjadi putih bersih agar terbaca */
    nav.bg-white a, nav.bg-white div {
        color: #ffffff !important;
    }

    /* 3. DROPDOWN USER FIX: Tombol nama di pojok kanan dibuat transparan dengan teks putih */
    nav.bg-white button.inline-flex {
        background-color: transparent !important; 
        color: #ffffff !important; 
        border: 1px solid rgba(255, 255, 255, 0.2) !important; 
        border-radius: 0.5rem !important;
    }

    /* Efek pas kursor nempel di tombol nama user */
    nav.bg-white button.inline-flex:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
    }

    /* Mengubah warna panah kecil (SVG) di sebelah nama user jadi putih */
    nav.bg-white button.inline-flex svg {
        stroke: #ffffff !important;
        fill: #ffffff !important;
    }

    /* 4. Mengubah warna sub-header menjadi Hijau Mint Pastel */
    header.bg-white {
        background-color: #ecfdf5 !important;
        border-bottom: 1px solid #dcf2e6 !important;
    }

    /* 5. Mengubah teks sub-header menjadi hijau gelap elegan */
    header.bg-white h2, header.bg-white span {
        color: #065f46 !important;
    }
</style>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Makanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 w-full h-80 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center border border-gray-200 shadow-sm relative">
                    @if($food->gambar)
                        @if(str_starts_with($food->gambar, 'images/') && file_exists(public_path($food->gambar)))
                            {{-- 1. Jika dari data seeder, ambil langsung dari folder public --}}
                            <img src="{{ asset($food->gambar) }}" alt="{{ $food->nama_makanan }}" class="w-full h-full object-cover">
                        @else
                            {{-- 2. Jika dari upload web, ambil lewat jembatan storage --}}
                            <img src="{{ asset('storage/' . str_replace('images/', '', $food->gambar)) }}" alt="{{ $food->nama_makanan }}" class="w-full h-full object-cover">
                        @endif
                    @else
                        {{-- Tampilan kalau donor kebetulan tidak upload foto --}}
                        <div class="text-center text-gray-400 p-4">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm">Tidak ada foto makanan</p>
                        </div>
                    @endif
                </div>

                <h1 class="text-3xl font-bold mb-2 text-gray-800">
                    {{ $food->nama_makanan }}
                </h1>
                
                {{-- Badge Status --}}
                <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full uppercase mb-6">
                    {{ $food->status }}
                </span>

                {{-- Deskripsi --}}
                <div class="mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <h3 class="font-semibold text-lg text-gray-800">
                        Deskripsi
                    </h3>
                    <p class="text-gray-600 mt-2 leading-relaxed">
                        {{ $food->deskripsi }}
                    </p>
                </div>

                {{-- Informasi Detail --}}
                <div class="space-y-2 text-sm text-gray-600 border-b border-gray-100 pb-6 mb-6">
                    <p><strong>Jumlah Tersedia:</strong> <span class="text-gray-800 font-medium">{{ $food->jumlah }} Porsi</span></p>
                    <p><strong>Lokasi:</strong> <span class="text-gray-800 font-medium">{{ $food->lokasi }}</span></p>
                    <p><strong>Expired:</strong> <span class="text-red-600 font-medium">{{ $food->expired_at }}</span></p>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    
                    <form method="POST" action="{{ route('claims.store') }}" class="flex gap-2 items-center m-0 flex-1 sm:flex-initial">
                        @csrf
                        <input type="hidden" name="food_id" value="{{ $food->id }}">

                        <input type="number" 
                               name="jumlah" 
                               min="1" 
                               max="{{ $food->jumlah }}" 
                               required 
                               placeholder="Jumlah klaim" 
                               class="border border-gray-300 rounded px-3 py-2 w-40 text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500">

                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded transition font-medium shadow-sm whitespace-nowrap">
                            Klaim Sekarang
                        </button>
                    </form>

                    {{-- Tombol kembali --}}
                    <a href="{{ route('claims.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition text-sm font-medium shadow-sm text-center sm:w-auto w-full">
                        Kembali
                    </a>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
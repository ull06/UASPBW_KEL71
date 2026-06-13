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

    /* 3. PERBAIKAN DROPDOWN USER: Tombol nama di pojok kanan dibuat transparan dengan teks putih */
    nav.bg-white button.inline-flex {
        background-color: transparent !important; /* Menghapus kotak putih polos */
        color: #ffffff !important; /* Membuat nama Budi Santoso jadi putih */
        border: 1px solid rgba(255, 255, 255, 0.2) !important; /* Memberi border tipis transparan */
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

    /* 4. Mengubah warna sub-header (Dashboard Receiver) menjadi Hijau Mint Pastel */
    header.bg-white {
        background-color: #ecfdf5 !important;
        border-bottom: 1px solid #dcf2e6 !important;
    }

    /* 5. Mengubah teks "Dashboard Receiver" menjadi hijau gelap elegan */
    header.bg-white h2, header.bg-white span {
        color: #065f46 !important;
    }
</style>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
            🤝 <span>{{ __('Dashboard Receiver') }}</span>
        </h2>
    </x-slot>

    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 sm:p-8 border border-slate-200/60">

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b border-slate-100 gap-4">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                            Daftar Makanan Tersedia
                        </h1>
                        <p class="text-xs text-slate-500 mt-1">Pilih dan klaim makanan layak konsumsi sebelum batas waktu kedaluwarsa.</p>
                    </div>
                    
                    {{-- TOMBOL RIWAYAT --}}
                    <a href="{{ route('claims.history') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition shadow-xs active:scale-95 flex items-center gap-1.5">
                        📋 Lihat Riwayat Klaim
                    </a>
                </div>

                {{-- NOTIFIKASI PESAN --}}
                @if(session('success'))
                    <div class="bg-emerald-50 text-emerald-800 p-4 rounded-xl mb-6 border border-emerald-200 text-xs font-medium flex items-center gap-2 shadow-2xs">
                        <span>✅</span> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-rose-50 text-rose-800 p-4 rounded-xl mb-6 border border-rose-200 text-xs font-medium flex items-center gap-2 shadow-2xs">
                        <span>❌</span> {{ session('error') }}
                    </div>
                @endif

                {{-- FORM PENCARIAN & FILTER --}}
                <form method="GET"
                    action="{{ route('claims.index') }}"
                    class="mb-8 flex flex-wrap gap-3 bg-slate-50 p-4 rounded-2xl border border-slate-100/80">

                    <div class="relative flex-1 min-w-[200px]">
                        <input type="text" 
                            name="cari" 
                            value="{{ $cari ?? '' }}" 
                            placeholder="🔍 Cari makanan..." 
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 bg-white transition shadow-2xs">
                    </div>

                    <div class="relative flex-1 min-w-[200px]">
                        <input type="text" 
                            name="lokasi" 
                            value="{{ $lokasi ?? '' }}" 
                            placeholder="📍 Cari lokasi terdekat..." 
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 bg-white transition shadow-2xs">
                    </div>

                    <button type="submit"
                            class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-2.5 rounded-xl transition text-xs font-bold shadow-xs active:scale-95">
                        Cari Menu
                    </button>

                    @if(($cari ?? false) || ($lokasi ?? false))
                        <a href="{{ route('claims.index') }}"
                        class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 px-5 py-2.5 rounded-xl flex items-center transition text-xs font-semibold shadow-2xs">
                            Reset
                        </a>
                    @endif
                </form>

                {{-- LIST MAKANAN --}}
                <div class="space-y-6">
                    @forelse ($foods as $food)
                        <div class="border border-slate-100 rounded-2xl p-5 sm:p-6 shadow-2xs hover:shadow-sm transition-all duration-300 bg-white relative group">
                        
                            {{-- WADAH GAMBAR --}}
                            <div class="mb-5 w-full h-56 bg-slate-50 rounded-xl overflow-hidden flex items-center justify-center border border-slate-100 relative">
                                @if($food->gambar)
                                    @if(str_starts_with($food->gambar, 'images/'))
                                        <img src="{{ asset($food->gambar) }}" alt="{{ $food->nama_makanan }}" class="w-full h-full object-cover group-hover:scale-[1.01] transition duration-500">
                                    @else
                                        <img src="{{ asset('storage/' . $food->gambar) }}" alt="{{ $food->nama_makanan }}" class="w-full h-full object-cover group-hover:scale-[1.01] transition duration-500">
                                    @endif
                                @else
                                    <div class="text-center text-slate-400 p-4">
                                        <svg class="mx-auto h-8 w-8 text-slate-300 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs font-medium">Tidak Ada Foto</span>
                                    </div>
                                @endif
                            </div>

                            <h2 class="text-xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition">
                                {{ $food->nama_makanan }}
                            </h2>

                            <p class="mt-2 text-xs text-slate-500 leading-relaxed max-w-4xl">
                                {{ $food->deskripsi }}
                            </p>

                            {{-- BADGE INFORMASI MINI HORIZONTAL --}}
                            <div class="mt-4 pt-4 border-t border-slate-50 flex flex-wrap gap-x-6 gap-y-2 text-xs text-slate-600">
                                <p class="flex items-center gap-1">📦 <span class="text-slate-400">Jumlah:</span> <span class="text-slate-800 font-bold bg-slate-100 px-2 py-0.5 rounded-md">{{ $food->jumlah }} Porsi</span></p>
                                <p class="flex items-center gap-1">📍 <span class="text-slate-400">Lokasi:</span> <span class="text-slate-800 font-semibold">{{ $food->lokasi }}</span></p>
                                <p class="flex items-center gap-1">⏰ <span class="text-slate-400">Expired:</span> <span class="text-rose-600 bg-rose-50 px-2 py-0.5 rounded-md font-bold border border-rose-100">{{ $food->expired_at }}</span></p>
                                
                                @php
                                    $statusClass = '';
                                    if ($food->status == 'tersedia') {
                                        $statusClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                    } elseif ($food->status == 'diklaim') {
                                        $statusClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                    } else {
                                        $statusClass = 'bg-rose-50 text-rose-700 border-rose-100';
                                    }
                                @endphp
                                <p class="flex items-center gap-1">
                                    💡 <span class="text-slate-400">Status:</span>
                                    <span class="{{ $statusClass }} text-[10px] font-extrabold px-2.5 py-0.5 rounded-lg uppercase tracking-wider border">
                                        {{ $food->status }}
                                    </span>
                                </p>
                            </div>

                            {{-- AREA BUTTON AKSI BAWAH --}}
                            <div class="mt-5 pt-4 border-t border-slate-50 flex flex-wrap items-center justify-between gap-4">
                                <a href="{{ route('claims.show', $food->id) }}" 
                                   class="border border-slate-200 text-slate-700 hover:bg-slate-50 px-4 py-2 rounded-xl text-xs font-bold transition shadow-2xs">
                                    Detail Makanan
                                </a>

                                <form method="POST" action="{{ route('claims.store') }}" class="flex gap-2 items-center m-0">
                                    @csrf
                                    <input type="hidden" name="food_id" value="{{ $food->id }}">

                                    <input type="number" 
                                           name="jumlah" 
                                           min="1" 
                                           max="{{ $food->jumlah }}" 
                                           required 
                                           placeholder="Porsi" 
                                           class="border border-slate-200 rounded-xl px-3 py-2 w-20 text-center text-xs focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 bg-slate-50/50 font-bold">

                                    <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2 rounded-xl text-xs font-extrabold transition shadow-xs whitespace-nowrap active:scale-95">
                                        Klaim Sekarang
                                    </button>
                                </form>
                            </div>

                        </div>
                    @empty
                        <div class="bg-slate-50 border border-dashed border-slate-200 text-slate-500 p-12 rounded-xl text-center text-xs font-medium">
                            📭 Tidak ada makanan tersedia saat ini.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
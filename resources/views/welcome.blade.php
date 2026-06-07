<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareBite - Sistem Donasi Makanan Berlebih</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- NAVBAR ELEMENT --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold text-green-600">Share<span class="text-gray-800">Bite</span></span>
                    <span class="text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded-full font-medium border border-green-100 hidden sm:inline-block">Sistem Donasi Makanan</span>
                </div>
                
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-green-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition shadow-sm">Daftar Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Teks Ajakan Utama (Kiri) -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-1.5 bg-orange-50 border border-orange-100 text-orange-700 px-3 py-1.5 rounded-full text-xs font-semibold tracking-wide uppercase">
                    🍕 Kurangi Food Waste, Atasi Kelaparan
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 tracking-tight leading-none">
                    Salurkan <span class="text-green-600">Makanan Berlebih</span> Untuk yang Membutuhkan
                </h1>
                
                <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                    ShareBite menjembatani para donatur makanan, katering, restoran, dan individu dengan panti asuhan serta masyarakat yang membutuhkan di sekitar kita wilayah Banda Aceh. Bersama, kita jaga bumi dan berbagi berkah.
                </p>

                <div class="flex flex-wrap gap-4 justify-center lg:justify-start pt-2">
                    <a href="{{ route('claims.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-4 rounded-xl transition transform hover:-translate-y-0.5 shadow-md text-base">
                        Lihat Makanan Tersedia →
                    </a>
                    <a href="{{ route('login') }}" class="bg-white hover:bg-gray-50 text-gray-800 border border-gray-300 font-semibold px-6 py-4 rounded-xl transition text-base shadow-sm">
                        Mulai Donasi Makanan
                    </a>
                </div>

                <!-- Mini Statistik / Info Tambahan -->
                <div class="pt-8 grid grid-cols-3 gap-4 border-t border-gray-200/80 max-w-md mx-auto lg:mx-0">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">100%</p>
                        <p class="text-xs text-gray-500 font-medium">Sistem Aman & Higienis</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">Terbuka</p>
                        <p class="text-xs text-gray-500 font-medium">Panti & Komunitas</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">Realtime</p>
                        <p class="text-xs text-gray-500 font-medium">Deteksi Lokasi</p>
                    </div>
                </div>
            </div>

            <!-- Visual Dekorasi Aplikasi (Kanan) -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-sm sm:max-w-md">
                    <!-- Background Glow Efek Estetik -->
                    <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-green-400 to-emerald-500 opacity-20 blur-xl"></div>
                    
                    <!-- Kotak Ilustrasi Utama -->
                    <div class="relative bg-white border border-gray-100 rounded-3xl shadow-xl p-8 space-y-6">
                        <div class="flex items-center justify-between border-b border-gray-50 pb-4">
                            <span class="font-bold text-gray-800">Sistem Donasi Aktif</span>
                            <span class="h-2.5 w-2.5 bg-green-500 rounded-full animate-pulse"></span>
                        </div>
                        
                        <!-- Simulasi Preview List Makanan -->
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-center gap-4">
                                <div class="bg-green-100 text-green-700 p-2.5 rounded-lg font-bold text-sm">MA</div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-gray-800">Mie Aceh Spesial</h4>
                                    <p class="text-xs text-gray-500">📍 Lokasi: Banda Aceh</p>
                                </div>
                                <span class="text-xs font-semibold bg-green-50 text-green-700 px-2 py-1 rounded">Tersedia</span>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-center gap-4 opacity-75">
                                <div class="bg-orange-100 text-orange-700 p-2.5 rounded-lg font-bold text-sm">NG</div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-gray-800">Nasi Goreng Kampung</h4>
                                    <p class="text-xs text-gray-500">📍 Lokasi: Darussalam</p>
                                </div>
                                <span class="text-xs font-semibold bg-gray-200 text-gray-600 px-2 py-1 rounded">Claimed</span>
                            </div>
                        </div>

                        <div class="text-center bg-green-50/50 p-4 rounded-xl border border-green-50">
                            <p class="text-xs text-green-800 font-medium">Mari bergabung mewujudkan aksi sosial bebas kelaparan bersama tim ShareBite!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    {{-- FOOTER ELEMENT --}}
    <footer class="bg-white border-t border-gray-100 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500 font-medium">
            &copy; 2026 ShareBite Proyek UAS PBW Kelompok 71. Semua Hak Dilindungi.
        </div>
    </footer>

</body>
</html>
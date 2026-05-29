<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Riwayat Klaim Makanan
            </h2>
            {{-- Tambahan: Tombol untuk navigasi balik ke katalog depan --}}
            <a href="{{ route('claims.index') }}" class="text-blue-500 hover:text-blue-600 text-sm font-medium transition">
                ← Kembali ke Katalog
            </a>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-3xl font-bold mb-6 text-gray-800">
                    History Klaim Saya
                </h1>

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4 border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @forelse ($claims as $claim)

                    <div class="border border-gray-200 rounded-lg p-5 mb-5 shadow-sm bg-white hover:shadow transition flex flex-col sm:flex-row gap-5 items-center">

                        {{-- SISIPAN: FOTO MINI MAKANAN YANG DIKLAIM --}}
                        <div class="w-full sm:w-24 h-24 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0 flex items-center justify-center border border-gray-100">
                            @if($claim->food && $claim->food->gambar)
                                <img src="{{ asset('storage/' . $claim->food->gambar) }}" alt="{{ $claim->food->nama_makanan }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center text-gray-400 p-2">
                                    <span class="text-[10px] block font-medium text-gray-400">No Photo</span>
                                </div>
                            @endif
                        </div>

                        {{-- DATA ASLI MILIKMU --}}
                        <div class="flex-1 w-full">
                            <h2 class="text-2xl font-bold text-gray-800">
                                {{ $claim->food->nama_makanan ?? 'Makanan Telah Dihapus' }}
                            </h2>

                            <div class="mt-3 space-y-1 text-sm text-gray-600">

                                <p>
                                    <strong>Jumlah Diklaim:</strong>
                                    <span class="text-gray-800 font-medium">{{ $claim->jumlah }} Porsi</span>
                                </p>

                                <p>
                                    <strong>Status:</strong>
                                    {{-- Desain badge warna dinamis sesuai status asli kamu --}}
                                    @if($claim->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full uppercase ml-1 border border-yellow-200">
                                            {{ $claim->status }}
                                        </span>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full uppercase ml-1 border border-green-200">
                                            {{ $claim->status }}
                                        </span>
                                    @endif
                                </p>

                                <p>
                                    <strong>Tanggal Klaim:</strong>
                                    <span class="text-gray-500">{{ $claim->created_at->format('d M Y, H:i') }} WIB</span>
                                </p>

                            </div>

                            {{-- Tombol batal klaim asli kamu (Hanya muncul jika statusnya masih pending) --}}
                            @if($claim->status == 'pending')
                                <form method="POST"
                                      action="{{ route('claims.destroy', $claim->id) }}"
                                      class="mt-4 m-0"
                                      onsubmit="return confirm('Apakah kamu yakin ingin membatalkan klaim ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-xs transition font-medium shadow-sm">
                                        Batalkan Klaim
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>

                @empty

                    <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg border border-yellow-200">
                        Belum ada riwayat klaim.
                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>
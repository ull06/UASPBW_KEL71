<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Makanan
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">

        <!-- FORM EDIT MAKANAN -->
        <form action="{{ route('foods.update', $food->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-4">
                <label>Nama Makanan</label>
                <input type="text"
                       name="nama_makanan"
                       value="{{ $food->nama_makanan }}"
                       class="w-full border p-2">
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2">{{ $food->deskripsi }}</textarea>
            </div>

            <!-- Jumlah -->
            <div class="mb-4">
                <label>Jumlah</label>
                <input type="number"
                       name="jumlah"
                       value="{{ $food->jumlah }}"
                       class="w-full border p-2">
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label>Lokasi</label>
                <input type="text"
                       name="lokasi"
                       value="{{ $food->lokasi }}"
                       class="w-full border p-2">
            </div>

            <!-- Expired -->
            <div class="mb-4">
                <label>Expired</label>
                <input type="datetime-local"
                       name="expired_at"
                       value="{{ \Carbon\Carbon::parse($food->expired_at)->format('Y-m-d\TH:i') }}"
                       class="w-full border p-2">
            </div>

            @if($food->gambar)
                <div class="mb-4">
                    <p class="text-sm text-gray-500">Gambar saat ini:</p>
                    @if(str_starts_with($food->gambar, 'images/'))
                        {{-- Jika dari seeder, langsung panggil dari folder public --}}
                        <img src="{{ asset($food->gambar) }}" class="w-40 rounded mt-2">
                    @else
                        {{-- Jika dari upload form web, panggil dari folder storage --}}
                        <img src="{{ asset('storage/' . $food->gambar) }}" class="w-40 rounded mt-2">
                    @endif
                </div>
            @endif

            <div class="mb-4">
                <label>Ganti Gambar (opsional)</label>
                <input type="file"
                       name="gambar"
                       class="w-full border p-2">
            </div>

            <!-- BUTTON -->
          <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition tracking-normal normal-case">
            {{ __('Update Makanan') }}
        </x-primary-button>

        </form>

    </div>
</x-app-layout>
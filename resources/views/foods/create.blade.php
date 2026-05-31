<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Makanan
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">

        <!-- FORM TAMBAH MAKANAN -->
        <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Makanan -->
            <div class="mb-4">
                <label>Nama Makanan</label>
                <input type="text" name="nama_makanan" class="w-full border p-2" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2"></textarea>
            </div>

            <!-- Jumlah -->
            <div class="mb-4">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="w-full border p-2" required>
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="w-full border p-2" required>
            </div>

            <!-- Expired -->
            <div class="mb-4">
                <label>Expired</label>
                <input type="datetime-local" name="expired_at" class="w-full border p-2">
            </div>

            <!-- Gambar -->
            <div class="mb-4">
                <label>Gambar</label>
                <input type="file" name="gambar" class="w-full">
            </div>

            <button class="bg-blue-500 text-white px-4 py-2">
                Simpan
            </button>
        </form>

    </div>
</x-app-layout>
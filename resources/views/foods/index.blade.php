<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Donor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3>Selamat Datang, <strong>{{ Auth::user()->name }}</strong></h3>

                    <p class="mt-2 text-sm text-gray-600">
                        Anda login sebagai: <strong>{{ Auth::user()->role }}</strong>
                    </p>

                    <hr class="my-6 border-gray-200">

                    <h2 class="text-lg font-bold mb-3 text-gray-800">Kelola Makanan</h2>

                    <ul class="list-disc pl-5 space-y-2 text-indigo-600 font-medium">
                        <li>Tambah Makanan</li>
                        <li>Lihat Daftar Makanan</li>
                        <li>Edit Makanan</li>
                        <li>Hapus Makanan</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
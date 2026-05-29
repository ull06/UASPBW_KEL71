@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-emerald-500">
                <p class="text-sm text-gray-500">Total User</p>
                <p class="text-3xl font-bold text-emerald-600">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <p class="text-sm text-gray-500">Total Donasi Makanan</p>
                <p class="text-3xl font-bold text-blue-600">{{ $totalFoods }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <p class="text-sm text-gray-500">Klaim Sukses</p>
                <p class="text-3xl font-bold text-green-600">{{ $totalClaims }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                <p class="text-sm text-gray-500">Klaim Pending</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $pendingClaims }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Selamat datang, Admin!</h3>
            <p class="text-gray-500 mt-1">Pantau semua aktivitas ShareBite dari sini.</p>
        </div>
    </div>
</div>
@endsection

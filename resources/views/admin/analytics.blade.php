@extends('layouts.app')

@section('content')
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- HEADER + FILTER TAHUN --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">Dashboard Analytics</h1>
            <p class="text-gray-500">Statistik sistem donasi makanan</p>
        </div>
        <form method="GET" action="{{ route('admin.analytics') }}" class="flex items-center gap-2">
            <label class="text-sm text-gray-600">Tahun:</label>
            <select name="year" onchange="this.form.submit()"
                class="border rounded px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                @for($y = date('Y'); $y >= 2024; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </form>
    </div>

    {{-- CARD STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <p class="text-gray-500 text-sm">Total Donasi</p>
            <p class="text-3xl font-bold text-blue-600">{{ $totalFoods }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <p class="text-gray-500 text-sm">Klaim Berhasil</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalAcceptedClaims }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <p class="text-gray-500 text-sm">Total Donor</p>
            <p class="text-3xl font-bold text-purple-600">{{ $totalDonors }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
            <p class="text-gray-500 text-sm">Total Receiver</p>
            <p class="text-3xl font-bold text-orange-600">{{ $totalReceivers }}</p>
        </div>
    </div>

    {{-- GRAFIK DONASI & KLAIM PER BULAN --}}
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Donasi & Klaim per Bulan ({{ $year }})</h2>
        <canvas id="chartMonthly" height="100"></canvas>
    </div>

    {{-- BARIS BAWAH: TOP MAKANAN + PIE STATUS + BAR LOKASI --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- TOP 5 MAKANAN --}}
        <div class="bg-white rounded-lg shadow p-6 md:col-span-1">
            <h2 class="text-lg font-semibold mb-4">Top 5 Makanan Diklaim</h2>
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">Makanan</th>
                        <th class="border p-2 text-center">Klaim</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topFoods as $food)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2">{{ $food->nama_makanan }}</td>
                        <td class="border p-2 text-center font-semibold">{{ $food->total_claim }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PIE: STATUS KLAIM --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Status Klaim</h2>
            <canvas id="chartStatus"></canvas>
        </div>

        {{-- BAR: DONASI PER LOKASI --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Donasi per Lokasi</h2>
            <canvas id="chartLocation"></canvas>
        </div>

    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // DATA DARI PHP
    const foodsMonthly  = @json($foodsMonthly);
    const claimsMonthly = @json($claimsMonthly);
    const claimsByStatus = @json($claimsByStatus);
    const foodsByLocation = @json($foodsByLocation);

    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    // Konversi ke array 12 bulan, key "01"-"12"
    const foodData  = [];
    const claimData = [];
    for (let i = 1; i <= 12; i++) {
        const key = String(i).padStart(2, '0');
        foodData.push(foodsMonthly[key] ?? 0);
        claimData.push(claimsMonthly[key] ?? 0);
    }

    // CHART 1: BAR — Donasi & Klaim per Bulan
    new Chart(document.getElementById('chartMonthly'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Donasi',
                    data: foodData,
                    backgroundColor: 'rgba(59,130,246,0.7)',
                    borderRadius: 4,
                },
                {
                    label: 'Klaim Berhasil',
                    data: claimData,
                    backgroundColor: 'rgba(34,197,94,0.7)',
                    borderRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // CHART 2: PIE — Status Klaim
    const statusLabels = Object.keys(claimsByStatus).map(s => s.charAt(0).toUpperCase() + s.slice(1));
    const statusData   = Object.values(claimsByStatus);
    new Chart(document.getElementById('chartStatus'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusData,
                backgroundColor: ['#facc15','#4ade80','#f87171'],
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // CHART 3: BAR HORIZONTAL — Donasi per Lokasi
    const locationLabels = foodsByLocation.map(f => f.lokasi);
    const locationData   = foodsByLocation.map(f => f.total);
    new Chart(document.getElementById('chartLocation'), {
        type: 'bar',
        data: {
            labels: locationLabels,
            datasets: [{
                label: 'Jumlah Donasi',
                data: locationData,
                backgroundColor: 'rgba(168,85,247,0.7)',
                borderRadius: 4,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
</script>

@endsection
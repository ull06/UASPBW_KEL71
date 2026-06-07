@extends('layouts.app')

@section('content')
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold">Dashboard Admin</h1>
            <p class="text-gray-500">Pantau semua aktivitas ShareBite dari sini.</p>
        </div>
        <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
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
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-emerald-500">
            <p class="text-sm text-gray-500">Total User</p>
            <p class="text-3xl font-bold text-emerald-600">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Total Donasi</p>
            <p class="text-3xl font-bold text-blue-600">{{ $totalFoods }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Klaim Berhasil</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalClaims }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Klaim Pending</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $pendingClaims }}</p>
        </div>
    </div>

    {{-- GRAFIK DONASI & KLAIM PER BULAN --}}
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">Donasi & Klaim per Bulan ({{ $year }})</h2>
        <canvas id="chartMonthly" height="80"></canvas>
    </div>

    {{-- BARIS BAWAH --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- TOP 5 MAKANAN --}}
        <div class="bg-white rounded-lg shadow p-6">
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

        {{-- BAR HORIZONTAL: DONASI PER LOKASI --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Donasi per Lokasi</h2>
            <canvas id="chartLocation"></canvas>
        </div>

    </div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const foodsMonthly   = @json($foodsMonthly);
    const claimsMonthly  = @json($claimsMonthly);
    const claimsByStatus = @json($claimsByStatus);
    const foodsByLocation = @json($foodsByLocation);

    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

    const foodData = [], claimData = [];
    for (let i = 1; i <= 12; i++) {
        const key = String(i).padStart(2, '0');
        foodData.push(foodsMonthly[key] ?? 0);
        claimData.push(claimsMonthly[key] ?? 0);
    }

    new Chart(document.getElementById('chartMonthly'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                { label: 'Donasi', data: foodData, backgroundColor: 'rgba(59,130,246,0.7)', borderRadius: 4 },
                { label: 'Klaim Berhasil', data: claimData, backgroundColor: 'rgba(34,197,94,0.7)', borderRadius: 4 }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    const statusLabels = Object.keys(claimsByStatus).map(s => s.charAt(0).toUpperCase() + s.slice(1));
    new Chart(document.getElementById('chartStatus'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{ data: Object.values(claimsByStatus), backgroundColor: ['#facc15','#4ade80','#f87171'] }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    new Chart(document.getElementById('chartLocation'), {
        type: 'bar',
        data: {
            labels: foodsByLocation.map(f => f.lokasi),
            datasets: [{ label: 'Jumlah Donasi', data: foodsByLocation.map(f => f.total), backgroundColor: 'rgba(168,85,247,0.7)', borderRadius: 4 }]
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
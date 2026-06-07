<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Food;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->year ?? date('Y');

        // CARD STATISTIK
        $totalFoods = Food::count();
        $totalAcceptedClaims = Claim::where('status', 'accepted')->count();
        $totalDonors = User::where('role', 'donor')->count();
        $totalReceivers = User::where('role', 'receiver')->count();

        // DONASI PER BULAN
        $foodsMonthly = Food::selectRaw("LPAD(MONTH(created_at), 2, '0') as month, COUNT(*) as total")
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // KLAIM PER BULAN
        $claimsMonthly = Claim::where('status', 'accepted')
            ->selectRaw("LPAD(MONTH(created_at), 2, '0') as month, COUNT(*) as total")
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // TOP 5 MAKANAN
        $topFoods = Food::select('foods.nama_makanan', DB::raw('COUNT(claims.id) as total_claim'))
            ->leftJoin('claims', 'foods.id', '=', 'claims.food_id')
            ->groupBy('foods.id', 'foods.nama_makanan')
            ->orderByDesc('total_claim')
            ->limit(5)
            ->get();

        // DONASI PER LOKASI
        $foodsByLocation = Food::selectRaw('lokasi, COUNT(*) as total')
            ->groupBy('lokasi')
            ->orderByDesc('total')
            ->get();

        // KLAIM PER STATUS
        $claimsByStatus = Claim::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return view('admin.analytics', compact(
            'totalFoods',
            'totalAcceptedClaims',
            'totalDonors',
            'totalReceivers',
            'foodsMonthly',
            'claimsMonthly',
            'topFoods',
            'foodsByLocation',
            'claimsByStatus',
            'year'
        ));
    }
}
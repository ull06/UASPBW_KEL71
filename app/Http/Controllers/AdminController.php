<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Claim;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // CARD ATAS
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalFoods = Food::count();
        $totalClaims = Claim::where('status', 'accepted')->count();
        $pendingClaims = Claim::where('status', 'pending')->count();

        // ANALYTICS
        $year = $request->year ?? date('Y');

        $totalDonors = User::where('role', 'donor')->count();
        $totalReceivers = User::where('role', 'receiver')->count();

        $foodsMonthly = Food::selectRaw("LPAD(MONTH(created_at), 2, '0') as month, COUNT(*) as total")
            ->whereYear('created_at', $year)
            ->groupBy('month')->orderBy('month')
            ->pluck('total', 'month')->toArray();

        $claimsMonthly = Claim::where('status', 'accepted')
            ->selectRaw("LPAD(MONTH(created_at), 2, '0') as month, COUNT(*) as total")
            ->whereYear('created_at', $year)
            ->groupBy('month')->orderBy('month')
            ->pluck('total', 'month')->toArray();

        $topFoods = Food::select('foods.nama_makanan', DB::raw('COUNT(claims.id) as total_claim'))
            ->leftJoin('claims', 'foods.id', '=', 'claims.food_id')
            ->groupBy('foods.id', 'foods.nama_makanan')
            ->orderByDesc('total_claim')->limit(5)->get();

        $foodsByLocation = Food::selectRaw('lokasi, COUNT(*) as total')
            ->groupBy('lokasi')->orderByDesc('total')->get();

        $claimsByStatus = Claim::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')->pluck('total', 'status')->toArray();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalFoods', 'totalClaims', 'pendingClaims',
            'year', 'totalDonors', 'totalReceivers',
            'foodsMonthly', 'claimsMonthly',
            'topFoods', 'foodsByLocation', 'claimsByStatus'
        ));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.users', compact('users'));
    }

    public function claims()
    {
        $claims = Claim::with(['user', 'food'])->get();
        return view('admin.claims', compact('claims'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Claim;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalFoods = Food::count();
        $totalClaims = Claim::where('status', 'accepted')->count();
        $pendingClaims = Claim::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalFoods',
            'totalClaims',
            'pendingClaims'
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
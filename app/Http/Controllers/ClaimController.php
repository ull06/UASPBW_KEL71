<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    // ===============================
    // Menampilkan makanan tersedia + fitur cari
    // ===============================
    public function index(Request $request)
    {
        // Ambil input pencarian nama makanan
        $cari = $request->input('cari');

        // Ambil input lokasi
        $lokasi = $request->input('lokasi');

        $query = Food::where('status', 'tersedia');

        // Search berdasarkan nama makanan
        if ($cari) {

            $query->where('nama_makanan', 'LIKE', '%' . $cari . '%');
        }

        // Search berdasarkan lokasi
        if ($lokasi) {
            $query->where('lokasi', 'LIKE', '%' . $lokasi . '%');
        }

        // Ambil hasil query
        $foods = $query->latest()->get();

        // Kirim ke view
        return view('claims.index', compact('foods', 'cari'));
    }

    // ===============================
    // Detail makanan
    // ===============================
    public function show(string $id)
    {
        $food = Food::findOrFail($id);

        return view('claims.show', compact('food'));
    }

    // ===============================
    // Simpan klaim makanan
    // ===============================
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cari makanan
        $food = Food::findOrFail($request->food_id);

        // Validasi stok
        if ($request->jumlah > $food->jumlah) {

            return redirect()->back()
                ->with('error', 'Jumlah klaim melebihi stok makanan!');
        }

        // Simpan claim
        Claim::create([
            'user_id' => Auth::id(),
            'food_id' => $food->id,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        // Kurangi stok makanan
        $food->jumlah -= $request->jumlah;

        // Jika stok habis
        if ($food->jumlah <= 0) {
            $food->status = 'habis';
        }

        $food->save();

        return redirect()->route('claims.index')
            ->with('success', 'Makanan berhasil diklaim!');
    }

    // ===============================
    // Riwayat claim receiver
    // ===============================
    public function history()
    {
        $claims = Claim::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('claims.history', compact('claims'));
    }

    // ===============================
    // Batalkan claim
    // ===============================
    public function destroy(string $id)
    {
        $claim = Claim::findOrFail($id);

        // Kembalikan stok makanan
        $food = Food::findOrFail($claim->food_id);

        $food->jumlah += $claim->jumlah;

        // Jika stok kembali ada
        if ($food->jumlah > 0) {
            $food->status = 'tersedia';
        }

        $food->save();

        // Hapus claim
        $claim->delete();

        return redirect()->route('claims.history')
            ->with('success', 'Klaim berhasil dibatalkan!');
    }
}
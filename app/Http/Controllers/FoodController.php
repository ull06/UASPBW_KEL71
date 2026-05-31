<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    // =========================
    // LIST FOOD (DONOR ONLY)
    // =========================
    public function index()
    {
        // hanya makanan milik user login
        $foods = Food::where('user_id', auth()->id())
                    ->latest()
                    ->get();

    // =========================
    // STATISTIK DASHBOARD
    // =========================
    
    $totalFoods = $foods->count();
    $tersedia = $foods->where('status', 'tersedia')->count();
    $habis = $foods->where('status', 'habis')->count();

    return view('foods.index', compact(
        'foods',
        'totalFoods',
        'tersedia',
        'habis'
    ));
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        return view('foods.create');
    }

    // =========================
    // STORE FOOD
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'deskripsi' => 'nullable',
            'jumlah' => 'required|integer',
            'lokasi' => 'required',
            'expired_at' => 'nullable|date',
            'gambar' => 'nullable|image'
        ]);

        // upload gambar
        $imagePath = null;

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('foods', 'public');
        }

        Food::create([
            'user_id' => auth()->id(),
            'nama_makanan' => $request->nama_makanan,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'lokasi' => $request->lokasi,
            'expired_at' => $request->expired_at,
            'gambar' => $imagePath,
            'status' => 'tersedia'
        ]);

        return redirect()->route('foods.index')
            ->with('success', 'Makanan berhasil ditambahkan');
    }

    // =========================
    // EDIT FORM
    // =========================
    public function edit(Food $food)
    {
        return view('foods.edit', compact('food'));
    }

    // =========================
    // UPDATE FOOD
    // =========================
   public function update(Request $request, Food $food)
   {
        $request->validate([
            'nama_makanan' => 'required',
            'jumlah' => 'required|integer',
            'lokasi' => 'required',
            'gambar' => 'nullable|image'
        ]);

        // update gambar jika ada
        if ($request->hasFile('gambar')) {

            // hapus gambar lama kalau ada
            if ($food->gambar) {
                Storage::disk('public')->delete($food->gambar);
            }

            // upload gambar baru
            $food->gambar = $request->file('gambar')->store('foods', 'public');
        }

        // update data lain
        $food->update([
            'nama_makanan' => $request->nama_makanan,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'lokasi' => $request->lokasi,
            'expired_at' => $request->expired_at,
            'gambar' => $food->gambar
        ]);

        return redirect()->route('foods.index')
            ->with('success', 'Data berhasil diupdate');
    }
    // =========================
    // DELETE FOOD
    // =========================
    public function destroy(Food $food)
    {
        // hapus gambar kalau ada
        if ($food->gambar) {
            Storage::disk('public')->delete($food->gambar);
        }

        $food->delete();

        return redirect()->route('foods.index')
            ->with('success', 'Data berhasil dihapus');
    }

    // =========================
    // SHOW (TIDAK DIPAKAI)
    // =========================
    public function show(Food $food)
    {
        return redirect()->route('foods.index');
    }
}
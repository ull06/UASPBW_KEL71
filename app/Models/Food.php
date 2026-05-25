<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // Menegaskan nama tabel di database
    protected $table = 'foods';

    // Membuka izin pengisian semua kolom (sangat aman untuk keperluan Seeder dan CRUD)
    protected $guarded = [];

    // Relasi balik: Satu makanan ini diinput oleh seorang User (Donor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke claims: Satu makanan bisa diklaim/diambil beberapa kali
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
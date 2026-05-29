<?php

namespace App\Models;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $table = 'claims';
    
    protected $guarded = []; // Membuka izin pengisian kolom

    // Relasi ke data makanan yang diambil
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    // Relasi ke user yang mengambil makanan (Receiver)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
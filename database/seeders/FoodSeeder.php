<?php

namespace Database\Seeders;

use App\Models\Claim;
use App\Models\Food;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Sebagai Donor (Pemberi Makanan)
        $donor = User::create([
            'name' => 'Rahmatul Ulya',
            'email' => 'ulya@example.com',
            'password' => Hash::make('password123'),
            'role' => 'donor', // Sudah sesuai dengan enum role di migration
        ]);

        // 2. Sebagai Receiver (Penerima/Pengambil Makanan)
        $receiver = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password123'),
            'role' => 'receiver', // Sudah sesuai dengan enum role di migration
        ]);

        // 3. Masukkan data makanan contoh (Milik si Donor)
        $mieAceh = Food::create([
            'user_id' => $donor->id,
            'nama_makanan' => 'Mie Aceh Spesial',
            'deskripsi' => 'Mie Aceh bumbu tebal, masih hangat dan dibungkus rapi. Dijamin halal.',
            'jumlah' => 5,
            'lokasi' => 'Banda Aceh',
            'expired_at' => now()->addHours(6),
            'gambar' => 'images/mie_aceh.png',
            'status' => 'tersedia', // Sesuai enum: ['tersedia', 'habis']
        ]);

        

        $nasiGoreng = Food::create([
            'user_id' => $donor->id,
            'nama_makanan' => 'Nasi Goreng Kampung',
            'deskripsi' => 'Nasi goreng porsi besar, lengkap dengan telur dadar iris. Belum tersentuh.',
            'jumlah' => 3,
            'lokasi' => 'Darussalam',
            'expired_at' => now()->addHours(4),
            'gambar' => null,
            'status' => 'tersedia', // Sesuai enum: ['tersedia', 'habis']
        ]);

        Food::create([
            'user_id' => $donor->id,
            'nama_makanan' => 'Sate Matang',
            'deskripsi' => 'Sate bumbu kacang khas Matang, sisa katering acara keluarga terdekat.',
            'jumlah' => 10,
            'lokasi' => 'Aceh Besar',
            'expired_at' => now()->addHours(8),
            'gambar' => null,
            'status' => 'tersedia', // Sesuai enum: ['tersedia', 'habis']
        ]);

        // 4. Masukkan data Klaim contoh
        Claim::create([
            'food_id' => $mieAceh->id,
            'user_id' => $receiver->id,
            'jumlah' => 2, 
            'status' => 'pending', // Sesuai enum: ['pending', 'accepted', 'rejected']
        ]);

        Claim::create([
            'food_id' => $nasiGoreng->id,
            'user_id' => $receiver->id,
            'jumlah' => 1, 
            'status' => 'accepted', // Sesuai enum: ['pending', 'accepted', 'rejected']
        ]);
    }
}
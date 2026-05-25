<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            //Menghubungkan ke tabel foods (makanan apa yang diambil)
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');

            //Menghubungkan ke tabel users (siapa penerima/mengambail makanan)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->integer('jumlah'); // berapa porsi yang di ambil

            // Status makanan
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};

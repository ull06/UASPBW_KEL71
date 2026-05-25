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
        Schema::create('foods', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nama_makanan');
        $table->text('deskripsi')->nullable();
        $table->integer('jumlah');
        $table->string('lokasi');
        $table->dateTime('expired_at')->nullable();
        $table->string('gambar')->nullable();
        $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kita panggil FoodSeeder agar mengeksekusi data
        $this->call([
            UserSeeder::class,
            FoodSeeder::class,
        ]);
    }
}
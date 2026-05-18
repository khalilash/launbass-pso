<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// PENTING: Import Seeder Pelanggan Anda
use Database\Seeders\PelangganSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder yang Anda butuhkan
        $this->call([
            PelangganSeeder::class, // INI YANG HILANG SEBELUMNYA!
            // Jika ada seeder lain seperti UserSeeder, tambahkan di sini
        ]);
    }
}

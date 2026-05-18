<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Tambahkan ini

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama sebelum memasukkan yang baru (hanya untuk testing)
        Schema::disableForeignKeyConstraints();
        DB::table('pelanggan')->truncate();
        Schema::enableForeignKeyConstraints();

        // Masukkan data contoh
        DB::table('pelanggan')->insert([
            [
                'nama' => 'Rafin',
                'alamat' => 'Keputih, Perum A Blok C. No 17, Surabaya, Jawa Timur, Indonesia',
                'telepon' => '082134852903',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dzaki',
                'alamat' => 'Educity Apartment, Tower Stanford, Surabaya, Jawa Timur, Indonesia',
                'telepon' => '082384583577',
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Alfan',
                'alamat' => 'Keputih, BME Blok 4, Surabaya, Jawa Timur, Indonesia',
                'telepon' => '081218911211',
                'aktif' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

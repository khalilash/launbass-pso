<?php

namespace Tests\Feature;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Paket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PesananFeatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function pesanan_dapat_disimpan_ke_database()
    {
        $pelanggan = Pelanggan::create([
            'nama'    => 'Budi Santoso',
            'telepon' => '08123456789',
            'alamat'  => 'Jl. Merdeka No. 1',
        ]);
        $pelanggan->refresh(); // Pastikan ID tersinkronisasi dari DB

        $paket = Paket::create([
            'IDKategori'    => 1,
            'Jenis_Layanan' => 'Reguler',
            'HargaPerKg'    => 5000,
            'Satuan'        => 'Kg',
        ]);
        $paket->refresh(); // Pastikan ID tersinkronisasi dari DB

        Pesanan::create([
            'IDPelanggan'     => $pelanggan->getKey(), // Menggunakan getKey() agar lebih aman
            'IDUser'          => 1,
            'Tanggal_Masuk'   => '2025-01-01',
            'Tanggal_Keluar'  => '2025-01-03',
            'Status_Pesanan'  => 'Diterima',
            'Total_Biaya'     => 50000,
            'Catatan'         => 'Test pesanan',
            'Tipe_Pengiriman' => 'Antar',
            'Berat_Kg'        => 2.5,
            'Jumlah_Pcs'      => 5,
            'IDPaket'         => $paket->getKey(), // Menggunakan getKey() agar lebih aman
        ]);

        $this->assertDatabaseHas('pesanan', [
            'Status_Pesanan' => 'Diterima',
            'Total_Biaya'    => 50000,
        ]);
    }

    #[Test]
    public function pesanan_dapat_diambil_dari_database()
    {
        $pelanggan = Pelanggan::create([
            'nama'    => 'Siti Rahayu',
            'telepon' => '08987654321',
            'alamat'  => 'Jl. Sudirman No. 5',
        ]);
        $pelanggan->refresh();

        $paket = Paket::create([
            'IDKategori'    => 1,
            'Jenis_Layanan' => 'Express',
            'HargaPerKg'    => 10000,
            'Satuan'        => 'Kg',
        ]);
        $paket->refresh();

        Pesanan::create([
            'IDPelanggan'     => $pelanggan->getKey(),
            'IDUser'          => 1,
            'Tanggal_Masuk'   => '2025-02-01',
            'Tanggal_Keluar'  => '2025-02-02',
            'Status_Pesanan'  => 'Selesai',
            'Total_Biaya'     => 100000,
            'Catatan'         => 'Express',
            'Tipe_Pengiriman' => 'Ambil',
            'Berat_Kg'        => 5.0,
            'Jumlah_Pcs'      => 10,
            'IDPaket'         => $paket->getKey(),
        ]);

        $pesanan = Pesanan::where('Status_Pesanan', 'Selesai')->first();

        $this->assertNotNull($pesanan);
        $this->assertEquals(100000, $pesanan->Total_Biaya);
    }

    #[Test]
    public function pesanan_memiliki_relasi_pelanggan_yang_benar()
    {
        $pelanggan = Pelanggan::create([
            'nama'    => 'Andi Wijaya',
            'telepon' => '08111222333',
            'alamat'  => 'Jl. Ahmad Yani No. 10',
        ]);
        $pelanggan->refresh();

        $paket = Paket::create([
            'IDKategori'    => 1,
            'Jenis_Layanan' => 'Reguler',
            'HargaPerKg'    => 5000,
            'Satuan'        => 'Kg',
        ]);
        $paket->refresh();

        $pesanan = Pesanan::create([
            'IDPelanggan'     => $pelanggan->getKey(),
            'IDUser'          => 1,
            'Tanggal_Masuk'   => '2025-03-01',
            'Tanggal_Keluar'  => '2025-03-03',
            'Status_Pesanan'  => 'Diproses',
            'Total_Biaya'     => 75000,
            'Catatan'         => '-',
            'Tipe_Pengiriman' => 'Antar',
            'Berat_Kg'        => 3.0,
            'Jumlah_Pcs'      => 7,
            'IDPaket'         => $paket->getKey(),
        ]);

        // Muat ulang data pesanan bersama dengan relasi pelanggannya
        $pesanan->refresh();

        $this->assertNotNull($pesanan->pelanggan);
        $this->assertEquals('Andi Wijaya', $pesanan->pelanggan->nama);
    }
}

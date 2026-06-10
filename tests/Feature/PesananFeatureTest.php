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
            'Nama'          => 'Budi Santoso',
            'Nomor_HP'      => '08123456789',
            'Email'         => 'budi@launbass.com',
            'Alamat'        => 'Jl. Merdeka No. 1',
            'Tanggal_Lahir' => '1990-05-15',
        ]);

        $paket = Paket::create([
            'IDKategori'    => 1,
            'Jenis_Layanan' => 'Reguler',
            'HargaPerKg'    => 5000,
            'Satuan'        => 'Kg',
        ]);

        Pesanan::create([
            'IDPelanggan'     => $pelanggan->IDPelanggan,
            'IDUser'          => 1,
            'Tanggal_Masuk'   => '2025-01-01',
            'Tanggal_Keluar'  => '2025-01-03',
            'Status_Pesanan'  => 'Diterima',
            'Total_Biaya'     => 50000,
            'Catatan'         => 'Test pesanan',
            'Tipe_Pengiriman' => 'Antar',
            'Berat_Kg'        => 2.5,
            'Jumlah_Pcs'      => 5,
            'IDPaket'         => $paket->IDPaket,
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
            'Nama'          => 'Siti Rahayu',
            'Nomor_HP'      => '08987654321',
            'Email'         => 'siti@launbass.com',
            'Alamat'        => 'Jl. Sudirman No. 5',
            'Tanggal_Lahir' => '1995-08-20',
        ]);

        $paket = Paket::create([
            'IDKategori'    => 1,
            'Jenis_Layanan' => 'Express',
            'HargaPerKg'    => 10000,
            'Satuan'        => 'Kg',
        ]);

        Pesanan::create([
            'IDPelanggan'     => $pelanggan->IDPelanggan,
            'IDUser'          => 1,
            'Tanggal_Masuk'   => '2025-02-01',
            'Tanggal_Keluar'  => '2025-02-02',
            'Status_Pesanan'  => 'Selesai',
            'Total_Biaya'     => 100000,
            'Catatan'         => 'Express',
            'Tipe_Pengiriman' => 'Ambil',
            'Berat_Kg'        => 5.0,
            'Jumlah_Pcs'      => 10,
            'IDPaket'         => $paket->IDPaket,
        ]);

        $pesanan = Pesanan::where('Status_Pesanan', 'Selesai')->first();

        $this->assertNotNull($pesanan);
        $this->assertEquals(100000, $pesanan->Total_Biaya);
    }

    #[Test]
    public function pesanan_memiliki_relasi_pelanggan_yang_benar()
    {
        $pelanggan = Pelanggan::create([
            'Nama'          => 'Andi Wijaya',
            'Nomor_HP'      => '08111222333',
            'Email'         => 'andi@launbass.com',
            'Alamat'        => 'Jl. Ahmad Yani No. 10',
            'Tanggal_Lahir' => '1988-03-10',
        ]);

        $paket = Paket::create([
            'IDKategori'    => 1,
            'Jenis_Layanan' => 'Reguler',
            'HargaPerKg'    => 5000,
            'Satuan'        => 'Kg',
        ]);

        $pesanan = Pesanan::create([
            'IDPelanggan'     => $pelanggan->IDPelanggan,
            'IDUser'          => 1,
            'Tanggal_Masuk'   => '2025-03-01',
            'Tanggal_Keluar'  => '2025-03-03',
            'Status_Pesanan'  => 'Diproses',
            'Total_Biaya'     => 75000,
            'Catatan'         => '-',
            'Tipe_Pengiriman' => 'Antar',
            'Berat_Kg'        => 3.0,
            'Jumlah_Pcs'      => 7,
            'IDPaket'         => $paket->IDPaket,
        ]);

        $this->assertEquals('Andi Wijaya', $pesanan->pelanggan->Nama);
    }
}

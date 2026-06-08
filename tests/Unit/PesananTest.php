<?php

namespace Tests\Unit;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Paket;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PesananTest extends TestCase
{
    #[Test]
    public function pesanan_memiliki_fillable_yang_benar()
    {
        $pesanan = new Pesanan();

        $expectedFillable = [
            'IDPelanggan',
            'IDUser',
            'Tanggal_Masuk',
            'Tanggal_Keluar',
            'Status_Pesanan',
            'Total_Biaya',
            'Catatan',
            'Tipe_Pengiriman',
            'Berat_Kg',
            'Jumlah_Pcs',
            'IDPaket',
        ];

        $this->assertEquals($expectedFillable, $pesanan->getFillable());
    }

    #[Test]
    public function pesanan_menggunakan_table_yang_benar()
    {
        $pesanan = new Pesanan();
        $this->assertEquals('pesanan', $pesanan->getTable());
    }

    #[Test]
    public function pesanan_menggunakan_primary_key_yang_benar()
    {
        $pesanan = new Pesanan();
        $this->assertEquals('IDPesanan', $pesanan->getKeyName());
    }

    #[Test]
    public function pesanan_timestamps_dinonaktifkan()
    {
        $pesanan = new Pesanan();
        $this->assertFalse($pesanan->usesTimestamps());
    }

    #[Test]
    public function pesanan_dapat_diisi_dengan_mass_assignment()
    {
        $data = [
            'IDPelanggan'     => 1,
            'IDUser'          => 1,
            'Tanggal_Masuk'   => '2025-01-01',
            'Tanggal_Keluar'  => '2025-01-03',
            'Status_Pesanan'  => 'Diterima',
            'Total_Biaya'     => 50000,
            'Catatan'         => 'Test catatan',
            'Tipe_Pengiriman' => 'Antar',
            'Berat_Kg'        => 2.5,
            'Jumlah_Pcs'      => 5,
            'IDPaket'         => 1,
        ];

        $pesanan = new Pesanan($data);

        $this->assertEquals(1, $pesanan->IDPelanggan);
        $this->assertEquals('Diterima', $pesanan->Status_Pesanan);
        $this->assertEquals(50000, $pesanan->Total_Biaya);
        $this->assertEquals(2.5, $pesanan->Berat_Kg);
    }

    #[Test]
    public function pesanan_memiliki_relasi_ke_pelanggan()
    {
        $pesanan = new Pesanan();
        $relasi  = $pesanan->pelanggan();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relasi);
        $this->assertInstanceOf(Pelanggan::class, $relasi->getRelated());
    }

    #[Test]
    public function pesanan_memiliki_relasi_ke_paket()
    {
        $pesanan = new Pesanan();
        $relasi  = $pesanan->paket();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relasi);
        $this->assertInstanceOf(Paket::class, $relasi->getRelated());
    }
}

<?php

namespace Tests\Unit;

use App\Models\Pemasukan;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PemasukanTest extends TestCase
{
    #[Test]
    public function pemasukan_memiliki_fillable_yang_benar()
    {
        $pemasukan = new Pemasukan();

        $expectedFillable = [
            'IDPesanan',
            'IDUser',
            'IDPelanggan',
            'Jumlah',
            'Tanggal_Transaksi',
        ];

        $this->assertEquals($expectedFillable, $pemasukan->getFillable());
    }

    #[Test]
    public function pemasukan_menggunakan_table_yang_benar()
    {
        $pemasukan = new Pemasukan();
        $this->assertEquals('pemasukan', $pemasukan->getTable());
    }

    #[Test]
    public function pemasukan_menggunakan_primary_key_yang_benar()
    {
        $pemasukan = new Pemasukan();
        $this->assertEquals('IDPemasukan', $pemasukan->getKeyName());
    }

    #[Test]
    public function pemasukan_timestamps_dinonaktifkan()
    {
        $pemasukan = new Pemasukan();
        $this->assertFalse($pemasukan->usesTimestamps());
    }

    #[Test]
    public function pemasukan_dapat_diisi_dengan_mass_assignment()
    {
        $data = [
            'IDPesanan'          => 1,
            'IDUser'             => 1,
            'IDPelanggan'        => 1,
            'Jumlah'             => 75000,
            'Tanggal_Transaksi'  => '2025-01-10',
        ];

        $pemasukan = new Pemasukan($data);

        $this->assertEquals(1, $pemasukan->IDPesanan);
        $this->assertEquals(75000, $pemasukan->Jumlah);
        $this->assertEquals('2025-01-10', $pemasukan->Tanggal_Transaksi);
    }

    #[Test]
    public function pemasukan_jumlah_harus_bernilai_positif()
    {
        $pemasukan = new Pemasukan(['Jumlah' => 100000]);
        $this->assertGreaterThan(0, $pemasukan->Jumlah);
    }

    #[Test]
    public function pemasukan_jumlah_harus_berupa_angka()
    {
        $pemasukan = new Pemasukan(['Jumlah' => 50000]);
        $this->assertIsNumeric($pemasukan->Jumlah);
    }
}

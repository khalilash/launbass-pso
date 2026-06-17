<?php

namespace Tests\Unit;

use App\Models\Pelanggan;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PelangganTest extends TestCase
{
    #[Test]
    public function pelanggan_memiliki_fillable_yang_benar()
    {
        $pelanggan = new Pelanggan();

        // Diubah menjadi huruf kecil dan disesuaikan dengan Model
        $expectedFillable = [
            'nama',
            'telepon',
            'alamat',
        ];

        $this->assertEquals($expectedFillable, $pelanggan->getFillable());
    }

    #[Test]
    public function pelanggan_menggunakan_table_yang_benar()
    {
        $pelanggan = new Pelanggan();
        $this->assertEquals('pelanggan', $pelanggan->getTable());
    }

    #[Test]
    public function pelanggan_menggunakan_primary_key_yang_benar()
    {
        $pelanggan = new Pelanggan();
        $this->assertEquals('IDPelanggan', $pelanggan->getKeyName());
    }

    #[Test]
    public function pelanggan_timestamps_dinonaktifkan()
    {
        $pelanggan = new Pelanggan();
        $this->assertFalse($pelanggan->usesTimestamps());
    }

    #[Test]
    public function pelanggan_dapat_diisi_dengan_mass_assignment()
    {
        // Data disesuaikan dengan kolom baru
        $data = [
            'nama'    => 'Budi Santoso',
            'telepon' => '08123456789',
            'alamat'  => 'Jl. Merdeka No. 1 Surabaya',
        ];

        $pelanggan = new Pelanggan($data);

        $this->assertEquals('Budi Santoso', $pelanggan->nama);
        $this->assertEquals('08123456789', $pelanggan->telepon);
        $this->assertEquals('Jl. Merdeka No. 1 Surabaya', $pelanggan->alamat);
    }

    #[Test]
    public function pelanggan_telepon_harus_berupa_string()
    {
        // Diubah dari Nomor_HP menjadi telepon
        $pelanggan = new Pelanggan(['telepon' => '08129999999']);
        $this->assertIsString($pelanggan->telepon);
    }
}

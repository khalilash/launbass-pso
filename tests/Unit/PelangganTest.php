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

        $expectedFillable = [
            'Nama',
            'Nomor_HP',
            'Email',
            'Alamat',
            'Tanggal_Lahir',
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
        $data = [
            'Nama'          => 'Budi Santoso',
            'Nomor_HP'      => '08123456789',
            'Email'         => 'budi@example.com',
            'Alamat'        => 'Jl. Merdeka No. 1 Surabaya',
            'Tanggal_Lahir' => '1990-05-15',
        ];

        $pelanggan = new Pelanggan($data);

        $this->assertEquals('Budi Santoso', $pelanggan->Nama);
        $this->assertEquals('08123456789', $pelanggan->Nomor_HP);
        $this->assertEquals('budi@example.com', $pelanggan->Email);
    }

    #[Test]
    public function pelanggan_email_harus_berupa_string()
    {
        $pelanggan = new Pelanggan(['Email' => 'test@launbass.com']);
        $this->assertIsString($pelanggan->Email);
    }

    #[Test]
    public function pelanggan_nomor_hp_harus_berupa_string()
    {
        $pelanggan = new Pelanggan(['Nomor_HP' => '08129999999']);
        $this->assertIsString($pelanggan->Nomor_HP);
    }
}

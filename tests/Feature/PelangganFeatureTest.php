<?php

namespace Tests\Feature;

use App\Models\Pelanggan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PelangganFeatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function pelanggan_dapat_disimpan_ke_database()
    {
        $data = [
            'Nama'          => 'Budi Santoso',
            'Nomor_HP'      => '08123456789',
            'Email'         => 'budi@launbass.com',
            'Alamat'        => 'Jl. Merdeka No. 1 Surabaya',
            'Tanggal_Lahir' => '1990-05-15',
        ];

        Pelanggan::create($data);

        $this->assertDatabaseHas('pelanggan', [
            'Nama'  => 'Budi Santoso',
            'Email' => 'budi@launbass.com',
        ]);
    }

    #[Test]
    public function pelanggan_dapat_diambil_dari_database()
    {
        Pelanggan::create([
            'Nama'          => 'Siti Rahayu',
            'Nomor_HP'      => '08987654321',
            'Email'         => 'siti@launbass.com',
            'Alamat'        => 'Jl. Sudirman No. 5 Surabaya',
            'Tanggal_Lahir' => '1995-08-20',
        ]);

        $pelanggan = Pelanggan::where('Email', 'siti@launbass.com')->first();

        $this->assertNotNull($pelanggan);
        $this->assertEquals('Siti Rahayu', $pelanggan->Nama);
    }

    #[Test]
    public function pelanggan_dapat_dihapus_dari_database()
    {
        $pelanggan = Pelanggan::create([
            'Nama'          => 'Andi Wijaya',
            'Nomor_HP'      => '08111222333',
            'Email'         => 'andi@launbass.com',
            'Alamat'        => 'Jl. Ahmad Yani No. 10',
            'Tanggal_Lahir' => '1988-03-10',
        ]);

        $pelanggan->delete();

        $this->assertDatabaseMissing('pelanggan', [
            'Email' => 'andi@launbass.com',
        ]);
    }
}

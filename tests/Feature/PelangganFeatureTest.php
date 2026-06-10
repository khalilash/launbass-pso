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
        Pelanggan::create([
            'nama'    => 'Budi Santoso',
            'alamat'  => 'Jl. Merdeka No. 1 Surabaya',
            'telepon' => '08123456789',
            'aktif'   => true,
        ]);

        $this->assertDatabaseHas('pelanggan', [
            'nama'    => 'Budi Santoso',
            'telepon' => '08123456789',
        ]);
    }

    #[Test]
    public function pelanggan_dapat_diambil_dari_database()
    {
        Pelanggan::create([
            'nama'    => 'Siti Rahayu',
            'alamat'  => 'Jl. Sudirman No. 5 Surabaya',
            'telepon' => '08987654321',
            'aktif'   => true,
        ]);

        $pelanggan = Pelanggan::where('telepon', '08987654321')->first();

        $this->assertNotNull($pelanggan);
        $this->assertEquals('Siti Rahayu', $pelanggan->nama);
    }

    #[Test]
    public function pelanggan_dapat_dihapus_dari_database()
    {
        $pelanggan = Pelanggan::create([
            'nama'    => 'Andi Wijaya',
            'alamat'  => 'Jl. Ahmad Yani No. 10',
            'telepon' => '08111222333',
            'aktif'   => true,
        ]);

        $pelanggan->delete();

        $this->assertDatabaseMissing('pelanggan', [
            'telepon' => '08111222333',
        ]);
    }

    #[Test]
    public function pelanggan_nonaktif_dapat_disimpan()
    {
        Pelanggan::create([
            'nama'    => 'Rudi Hermawan',
            'alamat'  => 'Jl. Diponegoro No. 20',
            'telepon' => '08555666777',
            'aktif'   => false,
        ]);

        $this->assertDatabaseHas('pelanggan', [
            'nama'  => 'Rudi Hermawan',
            'aktif' => false,
        ]);
    }
}

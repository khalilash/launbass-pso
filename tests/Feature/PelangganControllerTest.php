<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PelangganControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Update skema tabel agar memiliki semua kolom yang digunakan controller
        DB::statement('
            CREATE TABLE IF NOT EXISTS pelanggan (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nama TEXT,
                alamat TEXT,
                telepon TEXT,
                Email TEXT,
                Nomor_HP TEXT,
                aktif INTEGER DEFAULT 1
            )
        ');
    }

    public function test_halaman_index_pelanggan_bisa_diakses()
    {
        $response = $this->withSession(['user_id' => 1])->get('/pelanggan');
        $response->assertStatus(200);
    }

    public function test_bisa_tambah_pelanggan_baru()
    {
        $response = $this->withSession(['user_id' => 1])
                         ->post('/pelanggan', [
                             'Nama' => 'Budi Test',
                             'Email' => 'budi@test.com',
                             'Nomor_HP' => '0812345678',
                             'Alamat' => 'Jl. Testing No. 1'
                         ]);

        // Cek redirect (302)
        $response->assertStatus(302);

        // Cek apakah data masuk dengan nama kolom 'nama' (sesuai insert di Controller)
        $this->assertDatabaseHas('pelanggan', ['nama' => 'Budi Test']);
    }

    public function test_bisa_edit_dan_update_pelanggan()
    {
        DB::table('pelanggan')->insert([
            'id' => 1, 'nama' => 'Lama', 'alamat' => 'Alamat Lama', 'telepon' => '123', 'Email' => 'a@b.com', 'Nomor_HP' => '123'
        ]);

        $response = $this->withSession(['user_id' => 1])
                         ->put('/pelanggan/1', [
                             'Nama' => 'Baru',
                             'Email' => 'a@b.com',
                             'Nomor_HP' => '123',
                             'Alamat' => 'Alamat Baru'
                         ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('pelanggan', ['nama' => 'Baru']);
    }

    public function test_bisa_toggle_status_aktif_nonaktif()
    {
        DB::table('pelanggan')->insert([
            'id' => 2, 'nama' => 'Status Test', 'aktif' => 1, 'alamat' => 'Jl. Test', 'telepon' => '1', 'Email' => 'x@y.com', 'Nomor_HP' => '1'
        ]);

        $this->withSession(['user_id' => 1])->patch('/pelanggan/2/toggle-status');

        $this->assertDatabaseHas('pelanggan', ['id' => 2, 'aktif' => 0]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PembayaranControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Pastikan tabel pesanan dibuat dengan skema yang mendukung constraint
        DB::statement('CREATE TABLE IF NOT EXISTS pesanan (IDPesanan INTEGER PRIMARY KEY AUTOINCREMENT, IDPelanggan INTEGER, IDPaket INTEGER, IDUser INTEGER NOT NULL, Total_Biaya REAL, Status_Pesanan TEXT, Tanggal_Masuk DATETIME, Tipe_Pengiriman TEXT, Berat_Kg REAL, Jumlah_Pcs INTEGER)');
        DB::statement('CREATE TABLE IF NOT EXISTS pemasukan (id INTEGER PRIMARY KEY AUTOINCREMENT, IDUser INTEGER, Jumlah REAL, Tanggal_Transaksi DATETIME, Catatan TEXT)');
    }

    private function createDummyPesanan($status = 'Diproses')
    {
        return DB::table('pesanan')->insertGetId([
            'IDPelanggan' => 1,
            'IDPaket' => 1,
            'IDUser' => 1, // Wajib diisi!
            'Total_Biaya' => 50000,
            'Status_Pesanan' => $status,
            'Tanggal_Masuk' => now(),
            'Tipe_Pengiriman' => 'Pickup',
            'Berat_Kg' => 1,
            'Jumlah_Pcs' => 1
        ]);
    }

    public function test_halaman_pembayaran_cash_bisa_diakses()
    {
        $id = $this->createDummyPesanan();
        $this->get("/pembayaran/{$id}/cash")->assertStatus(200);
    }

    public function test_proses_pembayaran_cash_berhasil()
    {
        $id = $this->createDummyPesanan();

        $response = $this->withSession(['user_id' => 1])
                         ->post("/pembayaran/{$id}/cash", [
                             'total' => 50000,
                             'uang_diterima' => 50000
                         ]);

        $response->assertRedirect(route('pembayaran.berhasil', $id));
        $this->assertDatabaseHas('pesanan', ['IDPesanan' => $id, 'Status_Pesanan' => 'Dibayar']);
    }

    public function test_halaman_pembayaran_qris_bisa_diakses()
    {
        $id = $this->createDummyPesanan();
        $this->get("/pembayaran/{$id}/qris")->assertStatus(200);
    }

    public function test_proses_pembayaran_qris_berhasil()
    {
        $id = $this->createDummyPesanan();

        $response = $this->withSession(['user_id' => 1])
                         ->post("/pembayaran/{$id}/qris");

        $response->assertRedirect(route('pembayaran.berhasil', $id));
        $this->assertDatabaseHas('pesanan', ['IDPesanan' => $id, 'Status_Pesanan' => 'Dibayar']);
    }

    public function test_halaman_pembayaran_berhasil_bisa_diakses()
    {
        $id = $this->createDummyPesanan('Dibayar');
        $this->get("/pembayaran/berhasil/{$id}")->assertStatus(200);
    }
}

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
        // Setup tabel yang dibutuhkan
        DB::statement('CREATE TABLE IF NOT EXISTS pesanan (IDPesanan INTEGER PRIMARY KEY AUTOINCREMENT, IDPelanggan INTEGER, Total_Biaya REAL, Status_Pesanan TEXT)');
        DB::statement('CREATE TABLE IF NOT EXISTS pemasukan (id INTEGER PRIMARY KEY AUTOINCREMENT, IDUser INTEGER, Jumlah REAL, Tanggal_Transaksi DATETIME, Catatan TEXT)');
    }

    public function test_halaman_pembayaran_cash_bisa_diakses()
    {
        $id = DB::table('pesanan')->insertGetId(['IDPelanggan' => 1, 'Total_Biaya' => 50000, 'Status_Pesanan' => 'Diproses']);
        $this->get("/pembayaran/{$id}/cash")->assertStatus(200);
    }

    public function test_proses_pembayaran_cash_berhasil()
    {
        $id = DB::table('pesanan')->insertGetId(['IDPelanggan' => 1, 'Total_Biaya' => 50000, 'Status_Pesanan' => 'Diproses']);

        $response = $this->withSession(['user_id' => 1])
                         ->post("/pembayaran/{$id}/cash", [
                             'total' => 50000,
                             'uang_diterima' => 50000
                         ]);

        $response->assertRedirect(route('pembayaran.berhasil', $id));
        $this->assertDatabaseHas('pesanan', ['IDPesanan' => $id, 'Status_Pesanan' => 'Dibayar']);
        $this->assertDatabaseHas('pemasukan', ['Catatan' => 'Pembayaran Cash Pesanan #' . $id]);
    }

    public function test_halaman_pembayaran_qris_bisa_diakses()
    {
        $id = DB::table('pesanan')->insertGetId(['IDPelanggan' => 1, 'Total_Biaya' => 50000, 'Status_Pesanan' => 'Diproses']);
        $this->get("/pembayaran/{$id}/qris")->assertStatus(200);
    }

    public function test_proses_pembayaran_qris_berhasil()
    {
        $id = DB::table('pesanan')->insertGetId(['IDPelanggan' => 1, 'Total_Biaya' => 50000, 'Status_Pesanan' => 'Diproses']);

        $response = $this->withSession(['user_id' => 1])
                         ->post("/pembayaran/{$id}/qris");

        $response->assertRedirect(route('pembayaran.berhasil', $id));
        $this->assertDatabaseHas('pesanan', ['IDPesanan' => $id, 'Status_Pesanan' => 'Dibayar']);
    }

    public function test_halaman_pembayaran_berhasil_bisa_diakses()
    {
        $id = DB::table('pesanan')->insertGetId(['IDPelanggan' => 1, 'Total_Biaya' => 50000, 'Status_Pesanan' => 'Dibayar']);
        $this->get("/pembayaran/berhasil/{$id}")->assertStatus(200);
    }
}

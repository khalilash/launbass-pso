<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PesananControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Pastikan tabel paket memiliki kolom Satuan
        DB::statement('CREATE TABLE IF NOT EXISTS pelanggan (id INTEGER PRIMARY KEY AUTOINCREMENT, nama TEXT, alamat TEXT, telepon TEXT, aktif INTEGER DEFAULT 1, created_at DATETIME, updated_at DATETIME)');
        DB::statement('CREATE TABLE IF NOT EXISTS kategori_produk (IDKategori INTEGER PRIMARY KEY AUTOINCREMENT, Nama_Kategori TEXT)');
        DB::statement('CREATE TABLE IF NOT EXISTS paket (IDPaket INTEGER PRIMARY KEY AUTOINCREMENT, IDKategori INTEGER, Jenis_Layanan TEXT, HargaPerKg INTEGER, Satuan TEXT)');
        DB::statement('CREATE TABLE IF NOT EXISTS pesanan (IDPesanan INTEGER PRIMARY KEY AUTOINCREMENT, IDPelanggan INTEGER, IDPaket INTEGER, IDUser INTEGER, Tanggal_Masuk DATETIME, Status_Pesanan TEXT, Jumlah_Pcs INTEGER, Berat_Kg REAL, Total_Biaya REAL, Catatan TEXT, Tipe_Pengiriman TEXT, Tanggal_Keluar DATETIME)');
    }

    public function test_halaman_tambah_pesanan_bisa_diakses()
    {
        $this->withSession(['user_id' => 1])->get('/tambahpesanan')->assertStatus(200);
    }

    public function test_bisa_simpan_pesanan_baru()
    {
        $pelangganId = DB::table('pelanggan')->insertGetId(['nama' => 'Budi', 'alamat' => 'SBY', 'telepon' => '123', 'aktif' => 1]);
        $kategoriId = DB::table('kategori_produk')->insertGetId(['Nama_Kategori' => 'Cuci Kering']);
        // Tambahkan 'Satuan' di sini
        $paketId = DB::table('paket')->insertGetId([
            'IDKategori' => $kategoriId,
            'Jenis_Layanan' => 'Reguler',
            'HargaPerKg' => 10000,
            'Satuan' => 'Kg'
        ]);

        $response = $this->withSession(['user_id' => 1])
                         ->post('/pesanan', [
                             'pelanggan_id' => $pelangganId,
                             'paket_id' => $paketId,
                             'jumlah' => 2,
                             'berat' => 2.0,
                             'pengiriman' => 'Pickup',
                             'catatan' => 'Test'
                         ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('pesanan', ['IDPelanggan' => $pelangganId]);
    }

    public function test_bisa_lihat_detail_pesanan()
    {
        $id = DB::table('pesanan')->insertGetId([
            'IDPelanggan' => 1,
            'IDPaket' => 1,
            'IDUser' => 1,
            'Total_Biaya' => 10000,
            'Status_Pesanan' => 'Diproses',
            'Tanggal_Masuk' => now(),
            'Tipe_Pengiriman' => 'Pickup',
            'Berat_Kg' => 1,
            'Jumlah_Pcs' => 1
        ]);

        $this->withSession(['user_id' => 1])->get("/pesanan/{$id}/detail")->assertStatus(200);
    }
}

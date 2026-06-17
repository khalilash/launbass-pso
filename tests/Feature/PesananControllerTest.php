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
        // Setup tabel pendukung
        DB::statement('CREATE TABLE IF NOT EXISTS pelanggan (id INTEGER PRIMARY KEY AUTOINCREMENT, nama TEXT, aktif INTEGER DEFAULT 1)');
        DB::statement('CREATE TABLE IF NOT EXISTS kategori_produk (IDKategori INTEGER PRIMARY KEY AUTOINCREMENT, Nama_Kategori TEXT)');
        DB::statement('CREATE TABLE IF NOT EXISTS paket (IDPaket INTEGER PRIMARY KEY AUTOINCREMENT, IDKategori INTEGER, Jenis_Layanan TEXT, HargaPerKg INTEGER)');
    }

    public function test_halaman_tambah_pesanan_bisa_diakses()
    {
        $this->withSession(['user_id' => 1])->get('/tambahpesanan')->assertStatus(200);
    }

    public function test_bisa_simpan_pesanan_baru()
    {
        // Setup data pendukung
        $pelangganId = DB::table('pelanggan')->insertGetId(['nama' => 'Budi', 'aktif' => 1]);
        $kategoriId = DB::table('kategori_produk')->insertGetId(['Nama_Kategori' => 'Cuci Kering']);
        $paketId = DB::table('paket')->insertGetId(['IDKategori' => $kategoriId, 'Jenis_Layanan' => 'Reguler', 'HargaPerKg' => 10000]);

        $response = $this->withSession(['user_id' => 1])
                         ->post('/pesanan', [
                             'pelanggan_id' => $pelangganId,
                             'paket_id' => $paketId,
                             'jumlah' => 2,
                             'berat' => 2.0,
                             'pengiriman' => 'Pickup',
                             'catatan' => 'Test pesan'
                         ]);

        $response->assertStatus(302); // Redirect ke detail
        $this->assertDatabaseHas('pesanan', ['IDPelanggan' => $pelangganId, 'Total_Biaya' => 20000]);
    }

    public function test_pesanan_gagal_jika_paket_tidak_valid()
    {
        $pelangganId = DB::table('pelanggan')->insertGetId(['nama' => 'Budi', 'aktif' => 1]);

        $response = $this->withSession(['user_id' => 1])
                         ->post('/pesanan', [
                             'pelanggan_id' => $pelangganId,
                             'paket_id' => 999, // ID salah
                             'jumlah' => 1,
                             'berat' => 1.0,
                             'pengiriman' => 'Pickup'
                         ]);

        $response->assertStatus(302);
        $response->assertSessionHas('error');
    }

    public function test_bisa_lihat_detail_pesanan()
    {
        // Buat pesanan manual
        $id = DB::table('pesanan')->insertGetId([
            'IDPelanggan' => 1, 'IDPaket' => 1, 'IDUser' => 1, 'Total_Biaya' => 10000, 'Status_Pesanan' => 'Diproses'
        ]);

        $this->withSession(['user_id' => 1])->get("/pesanan/{$id}/detail")->assertStatus(200);
    }
}

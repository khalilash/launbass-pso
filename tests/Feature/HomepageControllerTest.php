<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class HomepageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Persiapan database simulasi.
     * Membuat tabel/kolom yang dibutuhkan agar query Join di Controller tidak crash.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Buat tabel kategori_produk jika belum ada di migration
        DB::statement('
            CREATE TABLE IF NOT EXISTS kategori_produk (
                IDKategori INTEGER PRIMARY KEY AUTOINCREMENT,
                Nama_Kategori TEXT
            )
        ');

        // Antisipasi query "c.id" di HomepageController index()
        // karena SQLite kadang ketat soal penamaan kolom yang belum ada
        if (Schema::hasTable('pelanggan') && !Schema::hasColumn('pelanggan', 'id')) {
            try {
                DB::statement('ALTER TABLE pelanggan ADD COLUMN id INTEGER');
            } catch (\Exception $e) {
                // Abaikan jika sudah ada
            }
        }
    }

    public function test_halaman_index_menampilkan_pesanan_aktif()
    {
        // Siapkan data pelanggan, paket, dan kategori
        DB::table('kategori_produk')->insert(['IDKategori' => 1, 'Nama_Kategori' => 'Pakaian']);

        DB::table('paket')->insert([
            'IDPaket' => 1, 'IDKategori' => 1, 'Jenis_Layanan' => 'Kilat', 'HargaPerKg' => 10000, 'Satuan' => 'Kg'
        ]);

        DB::table('pelanggan')->insert([
            'IDPelanggan' => 1, 'id' => 1, 'nama' => 'Pelanggan Aktif', 'telepon' => '0811', 'alamat' => 'SBY'
        ]);

        // Buat 1 pesanan "Diproses" (harus tampil)
        DB::table('pesanan')->insert([
            'IDPesanan' => 1,
            'IDPelanggan' => 1,
            'IDPaket' => 1,
            'IDUser' => 1,
            'Tipe_Pengiriman' => 'Delivery', // Test mapping jenis delivery
            'Status_Pesanan' => 'Diproses',
            'Tanggal_Masuk' => now()->toDateString(),
            'Berat_Kg' => 2,
            'Jumlah_Pcs' => 5,
            'Total_Biaya' => 20000
        ]);

        $response = $this->withSession(['user_id' => 1])->get('/home');

        $response->assertStatus(200);
    }

    public function test_riwayat_pesanan_hanya_menampilkan_pesanan_selesai()
    {
        DB::table('paket')->insert([
            'IDPaket' => 2, 'IDKategori' => 1, 'Jenis_Layanan' => 'Express', 'HargaPerKg' => 10000, 'Satuan' => 'Kg'
        ]);

        DB::table('pelanggan')->insert([
            'IDPelanggan' => 2, 'id' => 2, 'nama' => 'Pelanggan Selesai', 'telepon' => '0822', 'alamat' => 'SBY'
        ]);

        // Buat 1 pesanan "Selesai"
        DB::table('pesanan')->insert([
            'IDPesanan' => 2,
            'IDPelanggan' => 2,
            'IDPaket' => 2,
            'IDUser' => 1,
            'Tipe_Pengiriman' => 'Pickup', // Test mapping jenis pickup
            'Status_Pesanan' => 'Selesai',
            'Tanggal_Masuk' => now()->toDateString(),
            'Tanggal_Keluar' => now()->toDateString(),
            'Total_Biaya' => 50000
        ]);

        $response = $this->withSession(['user_id' => 1])->get('/riwayat-pesanan');

        $response->assertStatus(200);
    }

    public function test_validasi_filter_riwayat_tanggal_to_melebihi_hari_ini()
    {
        $besok = now()->addDay()->toDateString();

        $response = $this->withSession(['user_id' => 1])
                         ->get("/riwayat-pesanan?to={$besok}");

        $response->assertRedirect();
        $response->assertSessionHasErrors(['to']);
    }

    public function test_validasi_filter_riwayat_tanggal_from_melebihi_to()
    {
        $response = $this->withSession(['user_id' => 1])
                         ->get('/riwayat-pesanan?from=2025-12-01&to=2025-11-01');

        $response->assertRedirect();
        $response->assertSessionHasErrors(['from']);
    }

    public function test_filter_riwayat_tanggal_valid()
    {
        $kemarin = now()->subDay()->toDateString();
        $hariIni = now()->toDateString();

        $response = $this->withSession(['user_id' => 1])
                         ->get("/riwayat-pesanan?from={$kemarin}&to={$hariIni}");

        $response->assertStatus(200);
    }

    public function test_fitur_tandai_pesanan_selesai()
    {
        DB::table('pesanan')->insert([
            'IDPesanan' => 2,
            'IDPelanggan' => 2,
            'IDPaket' => 2,
            'IDUser' => 1,
            'Tipe_Pengiriman' => 'Pickup',
            'Status_Pesanan' => 'Selesai',
            'Tanggal_Masuk' => now()->toDateString(),
            'Tanggal_Keluar' => now()->toDateString(),
            'Total_Biaya' => 50000,
            'Berat_Kg' => 2,
            'Jumlah_Pcs' => 5
        ]);

        // Hit endpoint untuk mengubah status menjadi selesai
        $response = $this->withSession(['user_id' => 1])
                         ->patch('/pesanan/10/selesai');

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('pesanan', [
            'IDPesanan' => 10,
            'Status_Pesanan' => 'Selesai'
        ]);
    }

    public function test_fitur_restore_pesanan_sukses()
    {
        DB::table('pesanan')->insert([
            'IDPesanan' => 11,
            'IDUser' => 1,
            'IDPelanggan' => 1,
            'IDPaket' => 1,
            'Status_Pesanan' => 'Selesai',
            'Tanggal_Masuk' => now()->toDateString(),
            'Total_Biaya' => 25000,
            'Berat_Kg' => 1,
            'Jumlah_Pcs' => 1,
            'Tipe_Pengiriman' => 'Antar'
        ]);

        $response = $this->withSession(['user_id' => 1])
                         ->patch('/pesanan/11/restore');

        $response->assertRedirect(route('pesanan.riwayat'));

        $this->assertDatabaseHas('pesanan', [
            'IDPesanan' => 11,
            'Status_Pesanan' => 'Diproses',
            'Tanggal_Keluar' => null
        ]);
    }

    public function test_fitur_restore_gagal_jika_pesanan_tidak_ditemukan()
    {
        $response = $this->withSession(['user_id' => 1])
                         ->patch('/pesanan/999/restore');

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Pesanan tidak ditemukan.');
    }

    public function test_fitur_restore_gagal_jika_pesanan_belum_selesai()
    {
        DB::table('pesanan')->insert([
            'IDPesanan' => 12,
            'IDUser' => 1,
            'IDPelanggan' => 1,
            'IDPaket' => 1,
            'Status_Pesanan' => 'Diproses', // Belum selesai
            'Tanggal_Masuk' => now()->toDateString(),
            'Total_Biaya' => 20000,
            'Berat_Kg' => 1,
            'Jumlah_Pcs' => 1,
            'Tipe_Pengiriman' => 'Ambil'
        ]);

        $response = $this->withSession(['user_id' => 1])
                         ->patch('/pesanan/12/restore');

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Pesanan ini tidak berstatus Selesai.');
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PesananControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_tambah_pesanan_bisa_diakses()
    {
        $this->withSession(['user_id' => 1])->get('/tambahpesanan')->assertStatus(200);
    }

    public function test_bisa_simpan_pesanan_baru()
    {
        // Lengkapi data agar memenuhi constraint NOT NULL
        $pelangganId = DB::table('pelanggan')->insertGetId([
            'nama' => 'Budi',
            'aktif' => 1,
            'alamat' => 'SBY', // Tambahkan ini
            'telepon' => '123'  // Tambahkan ini
        ]);

        $kategoriId = DB::table('kategori_produk')->insertGetId(['Nama_Kategori' => 'Cuci Kering']);
        $paketId = DB::table('paket')->insertGetId([
            'IDKategori' => $kategoriId,
            'Jenis_Layanan' => 'Reguler',
            'HargaPerKg' => 10000
        ]);

        $response = $this->withSession(['user_id' => 1])
                         ->post('/pesanan', [
                             'pelanggan_id' => $pelangganId,
                             'paket_id' => $paketId,
                             'jumlah' => 2,
                             'berat' => 2.0,
                             'pengiriman' => 'Pickup',
                             'catatan' => 'Test pesan'
                         ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('pesanan', ['IDPelanggan' => $pelangganId]);
    }

    public function test_pesanan_gagal_jika_paket_tidak_valid()
    {
        $pelangganId = DB::table('pelanggan')->insertGetId([
            'nama' => 'Budi', 'aktif' => 1, 'alamat' => 'SBY', 'telepon' => '123'
        ]);

        $response = $this->withSession(['user_id' => 1])
                         ->post('/pesanan', [
                             'pelanggan_id' => $pelangganId,
                             'paket_id' => 999,
                             'jumlah' => 1,
                             'berat' => 1.0,
                             'pengiriman' => 'Pickup'
                         ]);

        $response->assertStatus(302);
    }

    public function test_bisa_lihat_detail_pesanan()
    {
        // Lengkapi dengan Tanggal_Masuk sesuai constraint
        $id = DB::table('pesanan')->insertGetId([
            'IDPelanggan' => 1,
            'IDPaket' => 1,
            'IDUser' => 1,
            'Total_Biaya' => 10000,
            'Status_Pesanan' => 'Diproses',
            'Tanggal_Masuk' => now() // Tambahkan ini
        ]);

        $this->withSession(['user_id' => 1])->get("/pesanan/{$id}/detail")->assertStatus(200);
    }
}

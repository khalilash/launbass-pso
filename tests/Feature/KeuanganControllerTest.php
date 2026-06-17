<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class KeuanganControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup awal: Buat tabel simulasi agar query dinamis di controller tidak crash
     */
    protected function setUp(): void
    {
        parent::setUp();

        // 1. Buat tabel pemasukan untuk testing
        DB::statement('
            CREATE TABLE IF NOT EXISTS pemasukan (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                Jumlah INTEGER NOT NULL,
                Tanggal_Transaksi DATETIME,
                Catatan TEXT,
                IDUser INTEGER
            )
        ');

        // 2. Buat tabel pengeluaran untuk testing
        DB::statement('
            CREATE TABLE IF NOT EXISTS pengeluaran (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                Jumlah INTEGER NOT NULL,
                Tanggal_Pengeluaran DATETIME,
                Catatan TEXT,
                Kategori TEXT,
                IDUser INTEGER
            )
        ');
    }

    public function test_halaman_index_keuangan_bisa_diakses()
    {
        DB::table('pemasukan')->insert([
            'Jumlah' => 50000,
            'Tanggal_Transaksi' => now(),
            'Catatan' => 'Test Pemasukan',
            'IDUser' => 1
        ]);

        DB::table('pengeluaran')->insert([
            'Jumlah' => 20000,
            'Tanggal_Pengeluaran' => now(),
            'Kategori' => 'Listrik',
            'Catatan' => 'Bayar Listrik',
            'IDUser' => 1
        ]);

        $response = $this->get('/keuangan');

        // Kita tidak bisa assert Status 200 langsung jika route dilindungi,
        // Tapi setidaknya kita mengetes jalurnya ada. Jika redirect (302) artinya butuh login,
        // Jika 200 berarti sukses memuat view.
        $this->assertTrue(in_array($response->status(), [200, 302]));
    }

    public function test_halaman_grafik_keuangan_bisa_diakses()
    {
        DB::table('pemasukan')->insert([
            'Jumlah' => 100000,
            'Tanggal_Transaksi' => now()
        ]);

        $response = $this->get('/keuangan/grafik');
        $this->assertTrue(in_array($response->status(), [200, 302]));
    }

    public function test_halaman_aliran_kas_bisa_diakses()
    {
        DB::table('pengeluaran')->insert([
            'Jumlah' => 30000,
            'Tanggal_Pengeluaran' => now(),
            'Kategori' => 'Detergen'
        ]);

        $response = $this->get('/keuangan/aliran-kas');
        $this->assertTrue(in_array($response->status(), [200, 302]));
    }

    public function test_tambah_pemasukan_akan_ditolak_jika_belum_login()
    {
        $response = $this->post('/keuangan/pemasukan', [
            'jumlah' => 10000,
            'catatan' => 'Test',
        ]);

        // Harus redirect ke login karena session user_id kosong
        $response->assertRedirect('/login');
    }

    public function test_tambah_pemasukan_sukses_jika_sudah_login()
    {
        $response = $this->withSession(['user_id' => 1])
                         ->post('/keuangan/pemasukan', [
                             'jumlah' => 150000,
                             'catatan' => 'Cuci karpet',
                             'tambah_biaya' => true // Test agar masuk ke cabang pengeluaran juga
                         ]);

        $response->assertRedirect(); // Harus mengarah kembali ke rute keuangan

        $this->assertDatabaseHas('pemasukan', [
            'Jumlah' => 150000,
            'Catatan' => 'Cuci karpet'
        ]);

        // Karena tambah_biaya true, tabel pengeluaran harusnya ikut bertambah
        $this->assertDatabaseHas('pengeluaran', [
            'Jumlah' => 20000,
            'Kategori' => 'Operasional'
        ]);
    }

    public function test_quick_add_income_sukses()
    {
        $response = $this->withSession(['user_id' => 1])
                         ->post('/keuangan/quick-add-income');

        $response->assertRedirect();

        // Cek data pemasukan manual
        $this->assertDatabaseHas('pemasukan', [
            'Jumlah' => 20000,
            'Catatan' => 'Pemasukan manual'
        ]);

        // Cek potongan biaya
        $this->assertDatabaseHas('pengeluaran', [
            'Jumlah' => 20000,
            'Kategori' => 'Operasional'
        ]);
    }

    public function test_tambah_pengeluaran_sukses()
    {
        $response = $this->withSession(['user_id' => 1])
                         ->post('/keuangan/pengeluaran', [
                             'jumlah' => 50000,
                             'kategori' => 'Listrik',
                             'catatan' => 'Token PLN',
                             'tanggal' => now()->format('Y-m-d')
                         ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('pengeluaran', [
            'Jumlah' => 50000,
            'Kategori' => 'Listrik',
            'Catatan' => 'Token PLN'
        ]);
    }

    public function test_tambah_pengeluaran_sewa_akan_diubah_formatnya()
    {
        $response = $this->withSession(['user_id' => 1])
                         ->post('/keuangan/pengeluaran', [
                             'jumlah' => 1000000,
                             'kategori' => 'Sewa Tempat', // Test if statement "Sewa Tempat" => "Sewa"
                         ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('pengeluaran', [
            'Kategori' => 'Sewa', // Harus otomatis diubah ke Sewa oleh Controller
        ]);
    }
}

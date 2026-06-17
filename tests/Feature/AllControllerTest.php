<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AllControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Setup tabel lengkap sesuai migrasi dan kebutuhan controller
        DB::statement('CREATE TABLE IF NOT EXISTS user (IDUser INTEGER PRIMARY KEY AUTOINCREMENT, Nama TEXT, Email TEXT UNIQUE, Password TEXT, Jabatan TEXT)');
        DB::statement('CREATE TABLE IF NOT EXISTS pelanggan (id INTEGER PRIMARY KEY AUTOINCREMENT, nama TEXT, alamat TEXT, telepon TEXT, aktif INTEGER DEFAULT 1, created_at DATETIME, updated_at DATETIME)');
        DB::statement('CREATE TABLE IF NOT EXISTS kategori_produk (IDKategori INTEGER PRIMARY KEY AUTOINCREMENT, Nama_Kategori TEXT)');
        DB::statement('CREATE TABLE IF NOT EXISTS paket (IDPaket INTEGER PRIMARY KEY AUTOINCREMENT, IDKategori INTEGER, Jenis_Layanan TEXT, HargaPerKg INTEGER, Satuan TEXT)');
        DB::statement('CREATE TABLE IF NOT EXISTS pesanan (IDPesanan INTEGER PRIMARY KEY AUTOINCREMENT, IDPelanggan INTEGER, IDPaket INTEGER, IDUser INTEGER NOT NULL, Total_Biaya REAL, Status_Pesanan TEXT, Tanggal_Masuk DATETIME, Tipe_Pengiriman TEXT, Berat_Kg REAL, Jumlah_Pcs INTEGER, Tanggal_Keluar DATETIME)');
        DB::statement('CREATE TABLE IF NOT EXISTS pemasukan (id INTEGER PRIMARY KEY AUTOINCREMENT, Jumlah REAL, Tanggal_Transaksi DATETIME, Catatan TEXT, IDUser INTEGER)');
        DB::statement('CREATE TABLE IF NOT EXISTS pengeluaran (id INTEGER PRIMARY KEY AUTOINCREMENT, Jumlah REAL, Tanggal_Pengeluaran DATETIME, Kategori TEXT, Catatan TEXT, IDUser INTEGER)');
        DB::statement('CREATE TABLE IF NOT EXISTS Password_Reset_Codes (Email TEXT, Code TEXT, Used INTEGER, Expires_At DATETIME, Created_At DATETIME)');
    }

    // --- 1. PELANGGAN ---
    public function test_pelanggan_controller()
    {
        $this->withSession(['user_id' => 1])->get('/pelanggan')->assertStatus(200);
        $this->post('/pelanggan', ['Nama' => 'Budi', 'Email' => 'budi@test.com', 'Nomor_HP' => '123', 'Alamat' => 'SBY'])->assertRedirect();
        $this->assertDatabaseHas('pelanggan', ['nama' => 'Budi']);
    }

    // --- 2. PESANAN ---
    public function test_pesanan_controller()
    {
        $pelangganId = DB::table('pelanggan')->insertGetId(['nama' => 'Budi', 'alamat' => 'SBY', 'telepon' => '123', 'aktif' => 1]);
        $kategoriId = DB::table('kategori_produk')->insertGetId(['Nama_Kategori' => 'Cuci']);
        $paketId = DB::table('paket')->insertGetId(['IDKategori' => $kategoriId, 'Jenis_Layanan' => 'Reguler', 'HargaPerKg' => 10000, 'Satuan' => 'Kg']);

        $this->withSession(['user_id' => 1])->post('/pesanan', [
            'pelanggan_id' => $pelangganId, 'paket_id' => $paketId, 'jumlah' => 1, 'berat' => 1.0, 'pengiriman' => 'Pickup'
        ])->assertStatus(302);
    }

    // --- 3. KEUANGAN ---
    public function test_keuangan_controller()
    {
        // Test Pemasukan & Pengeluaran
        $this->withSession(['user_id' => 1])->post('/keuangan/pemasukan', ['jumlah' => 50000, 'catatan' => 'Test'])->assertRedirect();
        $this->withSession(['user_id' => 1])->post('/keuangan/pengeluaran', ['jumlah' => 10000, 'kategori' => 'Listrik', 'catatan' => 'Bayar'])->assertRedirect();

        // Test Grafik & Aliran Kas
        $this->withSession(['user_id' => 1])->get('/grafik-keuangan')->assertStatus(200);
        $this->withSession(['user_id' => 1])->get('/aliran-kas')->assertStatus(200);

        $this->assertDatabaseHas('pemasukan', ['Jumlah' => 50000]);
        $this->assertDatabaseHas('pengeluaran', ['Jumlah' => 10000]);
    }

    // --- 4. PEMBAYARAN ---
    public function test_pembayaran_controller()
    {
        $id = DB::table('pesanan')->insertGetId(['IDPelanggan' => 1, 'IDPaket' => 1, 'IDUser' => 1, 'Total_Biaya' => 50000, 'Status_Pesanan' => 'Diproses', 'Tanggal_Masuk' => now(), 'Tipe_Pengiriman' => 'Pickup', 'Berat_Kg' => 1, 'Jumlah_Pcs' => 1]);
        $this->withSession(['user_id' => 1])->post("/pembayaran/{$id}/cash", ['total' => 50000, 'uang_diterima' => 50000])->assertRedirect();
        $this->assertDatabaseHas('pesanan', ['IDPesanan' => $id, 'Status_Pesanan' => 'Dibayar']);
    }

    // --- 5. AUTH (REGISTER & FORGOT PASSWORD) ---
    public function test_auth_controller()
    {
        // Register
        $this->post('/register', ['name' => 'User', 'email' => 'u@t.com', 'password' => 'secret123', 'password_confirmation' => 'secret123'])->assertRedirect('/home');

        // Forgot Password Flow
        DB::table('user')->insert(['Nama' => 'User', 'Email' => 'u@t.com', 'Password' => bcrypt('old')]);
        $this->post('/forgot-password', ['email' => 'u@t.com']);
        $code = session('reset_code_for_testing');
        $this->post('/forgot-password/verify', ['code' => $code])->assertRedirect(route('password.reset'));
        $this->post('/forgot-password/reset', ['password' => 'new12345', 'password_confirmation' => 'new12345'])->assertRedirect(route('password.reset'));
    }
}

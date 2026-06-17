<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class KeuanganControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Setup tabel yang dibutuhkan controller
        DB::statement('CREATE TABLE IF NOT EXISTS pemasukan (id INTEGER PRIMARY KEY AUTOINCREMENT, Jumlah REAL, Tanggal_Transaksi DATETIME, Catatan TEXT, IDUser INTEGER)');
        DB::statement('CREATE TABLE IF NOT EXISTS pengeluaran (id INTEGER PRIMARY KEY AUTOINCREMENT, Jumlah REAL, Tanggal_Pengeluaran DATETIME, Kategori TEXT, Catatan TEXT, IDUser INTEGER)');
    }

    public function test_halaman_index_keuangan_bisa_diakses()
    {
        $this->withSession(['user_id' => 1])->get('/keuangan')->assertStatus(200);
    }

    public function test_tambah_pemasukan_sukses()
    {
        $this->withSession(['user_id' => 1])
             ->post('/keuangan/pemasukan', [
                 'jumlah' => 50000,
                 'catatan' => 'Test Pemasukan',
                 'tambah_biaya' => true
             ])
             ->assertRedirect(route('keuangan'));

        $this->assertDatabaseHas('pemasukan', ['Jumlah' => 50000]);
        $this->assertDatabaseHas('pengeluaran', ['Kategori' => 'Operasional']);
    }

    public function test_quick_add_income_sukses()
    {
        $this->withSession(['user_id' => 1])
             ->post('/keuangan/pemasukan/quick')
             ->assertRedirect(route('keuangan'));

        $this->assertDatabaseHas('pemasukan', ['Catatan' => 'Pemasukan manual']);
    }

    public function test_tambah_pengeluaran_sukses()
    {
        $this->withSession(['user_id' => 1])
             ->post('/keuangan/pengeluaran', [
                 'jumlah' => 10000,
                 'kategori' => 'Listrik',
                 'catatan' => 'Bayar Listrik'
             ])
             ->assertRedirect(route('keuangan'));

        $this->assertDatabaseHas('pengeluaran', ['Kategori' => 'Listrik', 'Jumlah' => 10000]);
    }
}

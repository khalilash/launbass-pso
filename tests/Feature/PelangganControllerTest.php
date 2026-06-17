<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PelangganControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_index_pelanggan_bisa_diakses()
    {
        $this->withSession(['user_id' => 1])->get('/pelanggan')->assertStatus(200);
    }

    public function test_bisa_tambah_pelanggan_baru()
    {
        $this->withSession(['user_id' => 1])->post('/pelanggan', [
            'nama' => 'Budi',
            'alamat' => 'SBY',
            'telepon' => '0812345678'
        ])->assertRedirect();

        $this->assertDatabaseHas('pelanggan', ['nama' => 'Budi']);
    }

    public function test_bisa_edit_dan_update_pelanggan()
    {
        $id = DB::table('pelanggan')->insertGetId(['nama' => 'Lama', 'alamat' => 'A', 'telepon' => '1']);

        $this->withSession(['user_id' => 1])->put('/pelanggan/'.$id, [
            'nama' => 'Baru', 'alamat' => 'B', 'telepon' => '2'
        ])->assertRedirect();

        $this->assertDatabaseHas('pelanggan', ['nama' => 'Baru']);
    }

    public function test_bisa_toggle_status_aktif_nonaktif()
    {
        $id = DB::table('pelanggan')->insertGetId(['nama' => 'A', 'alamat' => 'A', 'telepon' => '1', 'aktif' => 1]);
        $this->withSession(['user_id' => 1])->patch('/pelanggan/'.$id.'/toggle-status');
        $this->assertDatabaseHas('pelanggan', ['id' => $id, 'aktif' => 0]);
    }
}

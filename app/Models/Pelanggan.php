<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Pastikan nama tabel benar jika tidak menggunakan standar plural bahasa Inggris
    protected $table = 'pelanggan';

    // Pastikan primary key benar jika bukan 'id'
    protected $primaryKey = 'IDPelanggan';

    // INI BAGIAN YANG PALING PENTING
    protected $fillable = [
        'nama',      // Pastikan ini menggunakan huruf kecil sesuai test/migrasi
        'telepon',
        'alamat',
    ];
}

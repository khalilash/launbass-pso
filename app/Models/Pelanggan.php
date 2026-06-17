<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $primaryKey = 'IDPelanggan';

    // TAMBAHKAN DUA BARIS INI (Sama seperti di Paket.php agar fitur delete() bekerja)
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'aktif',     // TAMBAHKAN INI agar kolom aktif bisa diisi lewat mass-assignment
    ];
}

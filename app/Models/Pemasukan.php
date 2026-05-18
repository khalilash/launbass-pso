<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'IDPemasukan';
    public $timestamps = false;
    protected $fillable = [
        'IDPesanan',
        'IDUser',
        'IDPelanggan',
        'Jumlah',
        'Tanggal_Transaksi',
    ];
}

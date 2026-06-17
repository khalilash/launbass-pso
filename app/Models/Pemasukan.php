<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'IDPemasukan';
    public $timestamps = false;
    protected $fillable = [
    'Jumlah',
    'Tanggal_Transaksi',
    'IDUser',
    'Catatan',
];
}

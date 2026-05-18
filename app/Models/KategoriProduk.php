<?php
// NRP: 5026231021| Nama: Zaskia Muazatun M
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    protected $table = 'kategori_produk';
    protected $primaryKey = 'IDKategori';
    public $timestamps = false;

    protected $fillable = ['Nama_Kategori'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'IDPaket';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'IDKategori',
        'Jenis_Layanan',
        'HargaPerKg',
        'Satuan'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'IDKategori', 'IDKategori');
    }
}

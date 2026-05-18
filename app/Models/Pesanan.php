<?php
// NRP: 5026231021| Nama: Zaskia Muazatun M
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'IDPesanan';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'IDPelanggan',
        'IDUser',
        'Tanggal_Masuk',
        'Tanggal_Keluar',
        'Status_Pesanan',
        'Total_Biaya',
        'Catatan',
        'Tipe_Pengiriman',
        'Berat_Kg',
        'Jumlah_Pcs',
        'IDPaket'
    ];

    // RELASI KE PELANGGAN
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'IDPelanggan', 'IDPelanggan');
    }

    // RELASI KE PAKET
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'IDPaket', 'IDPaket');
    }
}

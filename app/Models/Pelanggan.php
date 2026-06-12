<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'IDPelanggan';
    public $timestamps = false;

    protected $fillable = [
        'Nama',
        'Nomor_HP',
        'Email',
        'Alamat',
        'Tanggal_Lahir',
    ];
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pemasukan;

class PembayaranController extends Controller
{
    public function cashForm($id)
    {
        $pesanan = Pesanan::where('IDPesanan', $id)->firstOrFail();
        return view('pesanan.pembayaran_cash', compact('pesanan'));
    }

    public function processCash(Request $request, $id)
{
    $request->validate([
        'total' => 'required|numeric|min:0',
        'uang_diterima' => 'required|numeric|min:0',
    ]);

    $pesanan = Pesanan::where('IDPesanan', $id)->firstOrFail();

    Pemasukan::create([
        'IDUser' => session('user_id') ?? 1,
        'Jumlah' => $request->input('total'),
        'Tanggal_Transaksi' => now(),
        'Catatan' => 'Pembayaran Cash Pesanan #' . $id,
    ]);

    $pesanan->Status_Pesanan = 'Dibayar';
    $pesanan->save();

    return redirect()->route('pembayaran.berhasil', ['id' => $id]);
}

    public function processQris(Request $request, $id)
{
    $pesanan = Pesanan::where('IDPesanan', $id)->firstOrFail();

    Pemasukan::create([
        'IDUser' => session('user_id') ?? 1,
        'Jumlah' => $pesanan->Total_Biaya,
        'Tanggal_Transaksi' => now(),
        'Catatan' => 'Pembayaran QRIS Pesanan #' . $id,
    ]);

    $pesanan->Status_Pesanan = 'Dibayar';
    $pesanan->save();

    return redirect()->route('pembayaran.berhasil', ['id' => $id]);
}

    public function pembayaranBerhasil($id)
    {
    $pesanan = Pesanan::where('IDPesanan', $id)->firstOrFail();
    return view('pesanan.pembayaran_berhasil', compact('pesanan'));
    }

}

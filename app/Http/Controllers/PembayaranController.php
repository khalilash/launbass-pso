<?php
// NRP: 5026231021| Nama: Zaskia Muazatun M
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
            'IDPesanan' => $id,
            'IDUser' => session('user_id') ?? null,
            'Jumlah' => $request->input('total'),
            'Tanggal_Transaksi' => now(),
            'IDPelanggan' => $pesanan->IDPelanggan,
            'IDMetode_Pembayaran' => 1, // cash
        ]);

        $pesanan->Status_Pesanan = 'Dibayar';
        $pesanan->save();

        return redirect()->route('pembayaran.berhasil', ['id' => $id]);
    }

    public function qrisForm($id)
    {
        $pesanan = Pesanan::where('IDPesanan', $id)->firstOrFail();
        return view('pesanan.pembayaran_qris', compact('pesanan'));
    }

    public function processQris(Request $request, $id)
    {
        $pesanan = Pesanan::where('IDPesanan', $id)->firstOrFail();

        Pemasukan::create([
            'IDPesanan' => $id,
            'IDUser' => session('user_id') ?? null,
            'Jumlah' => $pesanan->Total_Biaya ?? $request->input('total', 0),
            'Tanggal_Transaksi' => now(),
            'IDPelanggan' => $pesanan->IDPelanggan,
            'IDMetode_Pembayaran' => 2, // QRIS
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

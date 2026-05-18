<?php
// NRP: 5026231021| Nama: Zaskia Muazatun M
// NRP: 5026231227 | Nama: Arjuna Veetaraq

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    public function create()
    {
        $pelanggans = DB::table('pelanggan')
            ->where('aktif', 1)
            ->select('IDPelanggan as id', 'Nama as nama')
            ->get();

        $kategoris = DB::table('kategori_produk')
            ->select('IDKategori', 'Nama_Kategori')
            ->get();
    
        $pakets = DB::table('paket')
            ->select('IDPaket', 'IDKategori', 'Jenis_Layanan', 'HargaPerKg')
            ->get()
            ->groupBy('IDKategori');
    
        return view('pesanan.tambahpesanan', compact(
            'pelanggans',
            'kategoris',
            'pakets'
        ));

    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,IDPelanggan',
            'paket_id' => 'required|exists:paket,IDPaket',
            'jumlah' => 'required|integer|min:1',
            'berat' => 'required|numeric|min:0.1',
            'pengiriman' => 'required|in:Pickup,Pengiriman',
            'catatan' => 'nullable|string',
        ]);


        $paket = DB::table('paket')
            ->where('IDPaket', $request->paket_id)
            ->first();

        if (!$paket) {
            return back()->with('error', 'Paket tidak valid');
        }

        $unitRate = $paket->HargaPerKg;

        $berat = max((float) $request->berat, 0.5);
        $total = round($berat * $unitRate);

        $insert = [
            'IDPelanggan' => (int) $request->pelanggan_id,
            'IDPaket' => (int) $request->paket_id,
            'IDUser' => (int) session('user_id'),
            'Tanggal_Masuk' => now(),
            'Status_Pesanan' => 'Diproses',
            'Jumlah_Pcs' => (int) $request->jumlah,
            'Berat_Kg' => (float) $berat,
            'Total_Biaya' => (float) $total,
            'Catatan' => $request->catatan,
            'Tipe_Pengiriman' => $request->pengiriman,
        ];




        try {
            $id = DB::table('pesanan')->insertGetId($insert);
        } catch (\Throwable $e) {
            Log::error('Failed to insert pesanan: ' . $e->getMessage(), ['payload' => $insert]);
            return redirect()->route('tambahpesanan')
                ->withInput()
                ->with('error', 'Gagal menyimpan pesanan.');
        }

        return redirect()->route('pesanan.detail', $id)
            ->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pesanan = DB::table('pesanan as p')
            ->leftJoin('pelanggan as pl', 'pl.IDPelanggan', '=', 'p.IDPelanggan')
            ->leftJoin('user as u', 'u.IDUser', '=', 'p.IDUser')
            ->leftJoin('paket as pk', 'pk.IDPaket', '=', 'p.IDPaket')
            ->select(
                'p.*',
                'pl.Nama as nama_pelanggan',
                'pl.Nomor_HP as no_telp',
                'pl.Alamat as alamat',
                'u.Nama as nama_user',
                'pk.Jenis_Layanan as nama_paket',
                'pk.HargaPerKg'
            )
            ->where('p.IDPesanan', $id)
            ->first();

        if (!$pesanan) {
            return redirect()->route('home')
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('pesanan.detailpesanan', compact('pesanan'));
    }

}

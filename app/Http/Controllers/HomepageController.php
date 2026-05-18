<?php
// NRP: 5026231206 | Nama: Rafael Dimas Khristianto
// NRP: 5026231227 | Nama: Arjuna Veetaraq
// Revised: DB-driven homepage + riwayat pesanan logic

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    /**
     * =========================
     * HOMEPAGE
     * tampilkan pesanan AKTIF
     * (Status_Pesanan != 'Selesai')
     * =========================
     */
    public function index()
    {
        $rows = DB::table('pesanan as p')
            ->leftJoin('pelanggan as c', 'c.IDPelanggan', '=', 'p.IDPelanggan')
            ->leftJoin('paket as pk', 'pk.IDPaket', '=', 'p.IDPaket')
            ->leftJoin('kategori_produk as kp', 'kp.IDKategori', '=', 'pk.IDKategori')
            ->where(function ($q) {
                $q->whereNull('p.Status_Pesanan')
                    ->orWhere('p.Status_Pesanan', '!=', 'Selesai');
            })
            ->orderBy('p.Tanggal_Masuk', 'desc')
            ->select(
                'p.IDPesanan',
                'p.Tipe_Pengiriman',
                'p.Berat_Kg',
                'p.Jumlah_Pcs',
                'p.Total_Biaya',
                'p.Catatan',
                'p.Status_Pesanan',
                'p.Tanggal_Masuk',

                'c.Nama as pelanggan_nama',
                'c.Nomor_HP as pelanggan_telepon',
                'c.Alamat as pelanggan_alamat',

                'pk.Jenis_Layanan as paket',
                'kp.Nama_Kategori as kategori'
            )
            ->get();

        $orders = $this->mapOrders($rows);

        return view('homepage', compact('orders'));
    }

    /**
     * =========================
     * DUE DATE
     * =========================
     */
    private function calculateDueDate($tanggalMasuk, $paket)
    {
        if (!$tanggalMasuk || !$paket)
            return '-';

        $hari = match (strtolower($paket)) {
            'kilat' => 1,
            'express' => 2,
            default => 3, // reguler
        };

        return date(
            'd/m',
            strtotime($tanggalMasuk . " +{$hari} days")
        );
    }

    /**
     * =========================
     * RIWAYAT PESANAN
     * hanya Status_Pesanan = 'Selesai'
     * =========================
     */
    public function history(Request $request)
    {
        $query = DB::table('pesanan as p')
            ->leftJoin('pelanggan as c', 'c.IDPelanggan', '=', 'p.IDPelanggan')
            ->where('p.Status_Pesanan', 'Selesai');

        /**
         * =========================
         * VALIDATION FILTER TANGGAL
         * =========================
         */
        $from = $request->query('from');
        $to = $request->query('to');
        $today = now()->toDateString();

        // rule 1: to tidak boleh melebihi hari ini
        if ($to && $to > $today) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'to' => 'Tanggal sampai tidak boleh melebihi hari ini.'
                ]);
        }

        // rule 2: from tidak boleh lebih besar dari to
        if ($from && $to && $from > $to) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'from' => 'Tanggal mulai tidak boleh melebihi tanggal akhir.'
                ]);
        }

        /**
         * =========================
         * APPLY FILTER (JIKA VALID)
         * =========================
         */
        if ($from) {
            $query->whereDate('p.Tanggal_Keluar', '>=', $from);
        }

        if ($to) {
            $query->whereDate('p.Tanggal_Keluar', '<=', $to);
        }

        $rows = $query
            ->orderBy('p.Tanggal_Keluar', 'desc')
            ->select(
                'p.IDPesanan',
                'p.Tipe_Pengiriman',
                'p.Berat_Kg',
                'p.Jumlah_Pcs',
                'p.Total_Biaya',
                'p.Catatan',
                'p.Status_Pesanan',
                'p.Tanggal_Keluar',
                'c.Nama as pelanggan_nama',
                'c.Nomor_HP as pelanggan_telepon',
                'c.Alamat as pelanggan_alamat'
            )
            ->get();

        $orders = $this->mapOrders($rows);

        return view('riwayatpesanan', compact('orders'));
    }


    /**
     * =========================
     * UPDATE STATUS → SELESAI
     * dipanggil dari tombol homepage
     * =========================
     */
    public function markAsFinished($id)
    {
        DB::table('pesanan')
            ->where('IDPesanan', $id)
            ->update([
                'Status_Pesanan' => 'Selesai',
                'Tanggal_Keluar' => now()
            ]);

        return redirect()->route('home');
    }

    /**
     * =========================
     * RESTORE BUTTON FUNCTION
     * =========================
     */

    public function restore($id)
    {
        // Ambil data pesanan
        $pesanan = DB::table('pesanan')
            ->where('IDPesanan', $id)
            ->first();

        // Validasi: pastikan pesanan ada
        if (!$pesanan) {
            return redirect()
                ->back()
                ->with('error', 'Pesanan tidak ditemukan.');
        }

        // Validasi: hanya boleh restore jika status Selesai
        if ($pesanan->Status_Pesanan !== 'Selesai') {
            return redirect()
                ->back()
                ->with('error', 'Pesanan ini tidak berstatus Selesai.');
        }

        // Update: kembalikan ke Diproses
        DB::table('pesanan')
            ->where('IDPesanan', $id)
            ->update([
                'Status_Pesanan' => 'Diproses',
                'Tanggal_Keluar' => null
            ]);

        return redirect()
            ->route('pesanan.riwayat')
            ->with('success', 'Pesanan berhasil direstore ke status Diproses.');
    }

    /**
     * =========================
     * HELPER: mapping DB → view
     * =========================
     */
    private function mapOrders($rows)
    {
        return $rows->map(function ($r) {

            $tipe = strtolower($r->Tipe_Pengiriman ?? '');

            $jenis = 'pickup'; // default

            if (
                str_contains($tipe, 'pengiriman') ||
                str_contains($tipe, 'delivery') ||
                str_contains($tipe, 'kirim')
            ) {
                $jenis = 'delivery';
            }


            return [
                'id' => $r->IDPesanan,
                'nama' => $r->pelanggan_nama ?? '-',
                'telepon' => $r->pelanggan_telepon ?? '-',
                'alamat' => $r->pelanggan_alamat ?? '',
                'berat' => $r->Berat_Kg ?? 0,
                'jumlah' => $r->Jumlah_Pcs ?? 0,
                'harga' => number_format($r->Total_Biaya ?? 0, 0, ',', '.'),
                'kategori' => $r->kategori ?? '-',
                'paket' => $r->paket ?? '-',
                'jenis' => $jenis,
                'status' => $r->Status_Pesanan ?? '',
                'due' => $this->calculateDueDate(
                    $r->Tanggal_Masuk ?? null,
                    $r->paket ?? null
                ),
                'catatan' => $r->Catatan ?? ''
            ];

        })->toArray();
    }
}

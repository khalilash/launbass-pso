<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PelangganController extends Controller
{
    /**
     * Display the pelanggan list.
     */
    public function index()
    {
        $pelanggan = DB::table('pelanggan')->get();
        return view('datapelanggan', compact('pelanggan'));
    }

    /**
     * Store a new pelanggan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama'          => 'required|string|max:255',
            'Email'         => 'required|email|max:255',
            'Nomor_HP'      => 'required|string|max:40',
            'Tanggal_Lahir' => 'nullable',
            'Alamat'        => 'required|string|max:1000',
        ]);

        try {
            DB::table('pelanggan')->insert([
                'nama'     => $validated['Nama'],
                'alamat'   => $validated['Alamat'],
                'telepon'  => $validated['Nomor_HP'],
                'email'    => $validated['Email'],    // Diseragamkan ke huruf kecil
                'nomor_hp' => $validated['Nomor_HP'], // Diseragamkan ke huruf kecil
                'aktif'    => 1,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to insert pelanggan: ' . $e->getMessage());
            return redirect()->route('datapelanggan')
                             ->withInput()
                             ->with('error', 'Gagal menyimpan data.');
        }

        return redirect()->route('datapelanggan')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $editData = DB::table('pelanggan')->where('id', $id)->first();

        if (!$editData) {
            return redirect()->route('datapelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $pelanggan = DB::table('pelanggan')->get();
        return view('datapelanggan', compact('pelanggan', 'editData'));
    }

    /**
     * Update pelanggan.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Nama'          => 'required|string|max:255',
            'Email'         => 'required|email|max:255',
            'Nomor_HP'      => 'required|string|max:40',
            'Tanggal_Lahir' => 'nullable',
            'Alamat'        => 'required|string|max:1000',
        ]);

        try {
            DB::table('pelanggan')->where('id', $id)->update([
                'nama'     => $validated['Nama'],
                'alamat'   => $validated['Alamat'],
                'telepon'  => $validated['Nomor_HP'],
                'email'    => $validated['Email'],    // Diseragamkan ke huruf kecil
                'nomor_hp' => $validated['Nomor_HP'], // Diseragamkan ke huruf kecil
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to update pelanggan: ' . $e->getMessage());
            return redirect()->route('datapelanggan')->with('error', 'Gagal memperbarui data.');
        }

        return redirect()->route('datapelanggan')->with('success', 'Pelanggan berhasil diperbarui!');
    }

    /**
     * Toggle status aktif/non-aktif.
     */
    public function toggleStatus($id)
    {
        try {
            $pelanggan = DB::table('pelanggan')->where('id', $id)->first();

            if (!$pelanggan) {
                return redirect()->route('datapelanggan')->with('error', 'Pelanggan tidak ditemukan.');
            }

            $newStatus = isset($pelanggan->aktif) && $pelanggan->aktif ? 0 : 1;

            DB::table('pelanggan')->where('id', $id)->update([
                'aktif' => $newStatus,
            ]);

            $message = $newStatus ? 'Pelanggan berhasil diaktifkan!' : 'Pelanggan berhasil dinonaktifkan!';
            return redirect()->route('datapelanggan')->with('success', $message);
        } catch (\Throwable $e) {
            Log::error('Failed to toggle status: ' . $e->getMessage());
            return redirect()->route('datapelanggan')->with('error', 'Gagal mengubah status.');
        }
    }
}

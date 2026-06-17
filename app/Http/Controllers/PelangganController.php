<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PelangganController extends Controller
{
    /**
     * Display the pelanggan list and the add form.
     */
    public function index()
    {
        // Table name - change if your DB uses different casing
        $table = 'pelanggan';

        // Fetch all pelanggan (you can add ordering/pagination later)
        $pelanggan = DB::table($table)->get();

        // Pass to the datapelanggan view
        return view('datapelanggan', compact('pelanggan'));
    }

    /**
     * Store a new pelanggan.
     */
    public function store(Request $request)
    {
        // Validate using the exact input names from the form (match DB columns)
        $validated = $request->validate([
    'Nama'           => 'required|string|max:255',
    'Email'          => 'required|email|max:255',
    'Nomor_HP'       => 'required|string|max:40',
    'Tanggal_Lahir'  => 'nullable',
    'Alamat'         => 'required|string|max:1000',
]);

        $table = 'pelanggan';

        try {
           DB::table($table)->insert([
    'nama'      => $validated['Nama'],
    'alamat'    => $validated['Alamat'],
    'telepon'   => $validated['Nomor_HP'],

    'Email'     => $validated['Email'],
    'Nomor_HP'  => $validated['Nomor_HP'],

    'aktif'     => 1,
]);
        } catch (\Throwable $e) {
            // Log error and return with friendly message
            Log::error('Failed to insert pelanggan: '.$e->getMessage(), [
                'payload' => $validated,
            ]);

            return redirect()->route('datapelanggan')
                             ->withInput()
                             ->with('error', 'Gagal menyimpan data pelanggan. Periksa konfigurasi database.');
        }

        return redirect()->route('datapelanggan')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    /**
     * Show edit form for a pelanggan.
     */
    public function edit($id)
    {
        $table = 'pelanggan';

        // Ambil data pelanggan yang akan diedit
        $editData = DB::table($table)->where('id', $id)->first();

        if (!$editData) {
            return redirect()->route('datapelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        // Ambil semua pelanggan untuk ditampilkan di list
        $pelanggan = DB::table($table)->get();

        // Return ke view yang sama dengan data edit
        return view('datapelanggan', compact('pelanggan', 'editData'));
    }

    /**
     * Update pelanggan.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Nama'           => 'required|string|max:255',
            'Email'          => 'required|email|max:255',
            'Nomor_HP'       => 'required|string|max:40',
            'Tanggal_Lahir'  => 'nullable',
            'Alamat'         => 'required|string|max:1000',
        ]);

        $table = 'pelanggan';

        try {
          DB::table($table)->where('id', $id)->update([
            'nama'      => $validated['Nama'],
            'alamat'    => $validated['Alamat'],
            'telepon'   => $validated['Nomor_HP'],

            'Email'     => $validated['Email'],
            'Nomor_HP'  => $validated['Nomor_HP'],
        ]);
        } catch (\Throwable $e) {
            Log::error('Failed to update pelanggan: '.$e->getMessage(), ['id' => $id, 'payload' => $validated]);
            return redirect()->route('datapelanggan')->with('error', 'Gagal memperbarui data pelanggan.');
        }

        return redirect()->route('datapelanggan')->with('success', 'Pelanggan berhasil diperbarui!');
    }

    /**
     * Delete pelanggan.
     */
    public function destroy($id)
    {
        $table = 'pelanggan';

        try {
            DB::table($table)->where('id', $id)->delete();
        } catch (\Throwable $e) {
            Log::error('Failed to delete pelanggan: '.$e->getMessage(), ['id' => $id]);
            return redirect()->route('datapelanggan')->with('error', 'Gagal menghapus pelanggan.');
        }

        return redirect()->route('datapelanggan')->with('success', 'Pelanggan berhasil dihapus!');
    }

    /**
     * Toggle status aktif/non-aktif pelanggan.
     */
    public function toggleStatus($id)
    {
        $table = 'pelanggan';

        try {
            // Get current status
            $pelanggan = DB::table($table)->where('id', $id)->first();

            if (!$pelanggan) {
                return redirect()->route('datapelanggan')->with('error', 'Pelanggan tidak ditemukan.');
            }

            // Toggle status (0 to 1, or 1 to 0)
            $newStatus = isset($pelanggan->aktif) && $pelanggan->aktif ? 0 : 1;

            DB::table($table)->where('id', $id)->update([
                'aktif' => $newStatus,
            ]);

            $message = $newStatus ? 'Pelanggan berhasil diaktifkan!' : 'Pelanggan berhasil dinonaktifkan!';

            return redirect()->route('datapelanggan')->with('success', $message);
        } catch (\Throwable $e) {
            Log::error('Failed to toggle status pelanggan: '.$e->getMessage(), ['id' => $id]);
            return redirect()->route('datapelanggan')->with('error', 'Gagal mengubah status pelanggan.');
        }
    }
}

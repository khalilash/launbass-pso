<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = DB::table('pelanggan')->get();
        return view('datapelanggan', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'alamat'  => 'required|string',
            'telepon' => 'required|string|max:15',
        ]);

        try {
            DB::table('pelanggan')->insert([
                'nama'    => $validated['nama'],
                'alamat'  => $validated['alamat'],
                'telepon' => $validated['telepon'],
                'aktif'   => 1,
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal simpan pelanggan: ' . $e->getMessage());
            return redirect()->route('datapelanggan')->with('error', 'Gagal menyimpan data.');
        }

        return redirect()->route('datapelanggan')->with('success', 'Berhasil!');
    }

    public function edit($id)
    {
        $editData = DB::table('pelanggan')->where('id', $id)->first();
        if (!$editData) return redirect()->route('datapelanggan')->with('error', 'Tidak ditemukan.');

        $pelanggan = DB::table('pelanggan')->get();
        return view('datapelanggan', compact('pelanggan', 'editData'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'alamat'  => 'required|string',
            'telepon' => 'required|string|max:15',
        ]);

        try {
            DB::table('pelanggan')->where('id', $id)->update($validated);
        } catch (\Throwable $e) {
            Log::error('Gagal update: ' . $e->getMessage());
            return redirect()->route('datapelanggan')->with('error', 'Gagal memperbarui.');
        }

        return redirect()->route('datapelanggan')->with('success', 'Berhasil diperbarui!');
    }

    public function toggleStatus($id)
    {
        $pelanggan = DB::table('pelanggan')->where('id', $id)->first();
        if (!$pelanggan) return redirect()->route('datapelanggan');

        DB::table('pelanggan')->where('id', $id)->update(['aktif' => !$pelanggan->aktif]);
        return redirect()->route('datapelanggan')->with('success', 'Status diubah!');
    }
}

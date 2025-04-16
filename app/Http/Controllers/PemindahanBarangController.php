<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PemindahanBarang;
use App\Models\Ruangan;
use App\Models\Unit;
use Illuminate\Http\Request;

class PemindahanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemindahans = PemindahanBarang::all();
        return view('pemindahan.index', compact('pemindahans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::whereNotIn('kondisi', ['Rusak', 'Butuh Perbaikan', 'Dipinjamkan'])->get();
        $units = Unit::all();
        $ruangans = Ruangan::all();
        return view('pemindahan.create', compact('barangs', 'units', 'ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'unit_asal_id' => 'required|exists:units,id',
            'unit_tujuan_id' => 'required|exists:units,id',
            'ruangan_asal_id' => 'required|exists:ruangans,id',
            'ruangan_tujuan_id' => 'required|exists:ruangans,id',
            'tanggal_pemindahan' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Cek apakah pindah unit atau ruangan
        $isDifferent = $barang->unit_id != $request->unit_tujuan_id || $barang->ruangan_id != $request->ruangan_tujuan_id;

        if ($isDifferent) {
            // Buat barang baru di tujuan
            $newBarang = $barang->replicate();
            $newBarang->unit_id = $request->unit_tujuan_id;
            $newBarang->ruangan_id = $request->ruangan_tujuan_id;
            $newBarang->save();

            // Tandai barang lama sudah dipindahkan (optional: bisa dihapus juga)
            $barang->kondisi = 'Dipindahkan';
            $barang->save();
        } else {
            // Kalau lokasi sama, update saja lokasi
            $barang->unit_id = $request->unit_tujuan_id;
            $barang->ruangan_id = $request->ruangan_tujuan_id;
            $barang->save();
        }

        // Simpan histori pemindahan
        PemindahanBarang::create($request->all());

        return redirect()->route('pemindahan.index')->with('success', 'Barang berhasil dipindahkan.');
    }




    /**
     * Display the specified resource.
     */
    public function show(PemindahanBarang $pemindahanBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PemindahanBarang $pemindahanBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PemindahanBarang $pemindahanBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PemindahanBarang $pemindahanBarang)
    {
        //
    }
}

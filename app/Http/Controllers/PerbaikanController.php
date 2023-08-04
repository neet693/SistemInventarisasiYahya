<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Perbaikan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikans = Perbaikan::all();
        return view('perbaikans.index', compact('perbaikans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $ruangans = Ruangan::all();
        return view('perbaikans.create', compact('barangs', 'ruangans'));
    }

    public function store(Request $request)
    {
        // Buat data perbaikan baru
        $perbaikan = Perbaikan::create($request->all());

        // Kurangi jumlah barang hanya jika status perbaikan belum selesai
        if ($request->status_perbaikan != 'Selesai') {
            $barang = Barang::findOrFail($request->barang_id);
            $barang->jumlah -= $request->jumlah;
            $barang->save();
        }

        return redirect()->route('perbaikans.index')->with('success', 'Data perbaikan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $perbaikan = Perbaikan::find($id);
        return view('perbaikans.show', compact('perbaikan'));
    }

    public function edit($id)
    {
        $perbaikan = Perbaikan::find($id);
        // Cek apakah status perbaikan sudah selesai
        if ($perbaikan->is_selesai == true) {
            return redirect()->route('perbaikans.show', $id)->with('error', 'Perbaikan sudah selesai dan tidak dapat diubah.');
        }
        $barangs = Barang::all();
        $ruangans = Ruangan::all();
        return view('perbaikans.edit', compact('perbaikan', 'barangs', 'ruangans'));
    }

    public function update(Request $request, $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);

        // Cek apakah status perbaikan sudah selesai
        if ($perbaikan->status_perbaikan->status === 'Selesai') {
            return redirect()->route('perbaikans.show', $id)->with('error', 'Perbaikan sudah selesai dan tidak dapat diubah.');
        }

        // Hitung selisih jumlah barang sebelum dan setelah diupdate
        $selisihJumlah = $perbaikan->jumlah - $request->jumlah;

        // Update data perbaikan dengan data baru dari form
        $perbaikan->update($request->all());

        if ($selisihJumlah != 0) {
            $barang = Barang::findOrFail($perbaikan->barang_id);
            $barang->jumlah -= $selisihJumlah;
            $barang->save();
        }

        return redirect()->route('perbaikans.index')->with('success', 'Data perbaikan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $perbaikan = Perbaikan::find($id);
        $perbaikan->delete();
        return redirect()->route('perbaikans.index')->with('success', 'Data perbaikan berhasil dihapus.');
    }
}

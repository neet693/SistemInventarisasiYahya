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
        Perbaikan::create($request->all());
        $barang = Barang::findOrFail($request->barang_id);
        $barang->jumlah -= $request->jumlah;
        $barang->save();
        return redirect()->route('perbaikans.index')->with('success', 'Data perbaikan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $perbaikan = Perbaikan::find($id);
        return view('perbaikans.show', compact('perbaikan'));
    }

    public function edit($id)
    {
        $barangs = Barang::all();
        $ruangans = Ruangan::all();
        $perbaikan = Perbaikan::find($id);
        return view('perbaikans.edit', compact('perbaikan', 'barangs', 'ruangans'));
    }

    public function update(Request $request, $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);

        // Hitung selisih jumlah barang sebelum dan setelah diupdate
        $selisihJumlah = $perbaikan->jumlah - $request->jumlah;

        // Update data perbaikan dengan data baru dari form
        $perbaikan->update($request->all());

        // // Update jumlah barang yang diperbaiki pada tabel barang
        // $barang = Barang::findOrFail($perbaikan->barang_id);
        // $barang->jumlah += $selisihJumlah;
        // $barang->save();

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

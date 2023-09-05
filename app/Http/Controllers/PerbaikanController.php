<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penempatan;
use App\Models\Perbaikan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        $perbaikans = Perbaikan::all();
        $ruangans = Ruangan::all();
        return view('perbaikans.index', compact('perbaikans', 'ruangans'));
    }

    public function create()
    {
        $penempatans = Penempatan::all();
        $ruangans = Ruangan::all();
        return view('perbaikans.create', compact('penempatans', 'ruangans'));
    }

    public function store(Request $request)
    {
        // Buat data perbaikan baru
        $penempatan = Penempatan::find($request->kode_ruangan);
        $penempatan->jumlah_ditempatkan -= $request->jumlah_perbaikan;
        $penempatan->save();
        Perbaikan::create($request->all());

        return redirect()->back()->with('success', 'Data perbaikan berhasil ditambahkan.');
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
        // $barangs = Barang::all();
        $penempatans = Penempatan::all();
        return view('perbaikans.edit', compact('perbaikan', 'penempatans'));
    }

    public function update(Request $request, $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);

        // Cek apakah status perbaikan sudah selesai
        if ($perbaikan->status_perbaikan->status === 'Selesai') {
            return redirect()->route('perbaikans.show', $id)->with('error', 'Perbaikan sudah selesai dan tidak dapat diubah.');
        }

        // Hitung selisih jumlah barang sebelum dan setelah diupdate
        $selisihJumlah = $perbaikan->jumlah_ditempatkan - $request->jumlah_diperbaiki;

        // Update data perbaikan dengan data baru dari form
        $perbaikan->update($request->all());

        if ($selisihJumlah != 0) {
            $penempatan = Penempatan::find($request->kode_ruangan);
            $penempatan->jumlah_ditempatkan -= $selisihJumlah;
            $penempatan->save();
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

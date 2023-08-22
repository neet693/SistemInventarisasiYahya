<?php

namespace App\Http\Controllers;

use App\Events\PenempatanCreated;
use App\Models\Barang;
use App\Models\JenisRuangan;
use App\Models\Penempatan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PenempatanController extends Controller
{
    public function index()
    {
        $penempatans = Penempatan::all();
        return view('penempatans.index', compact('penempatans'));
    }

    public function create()
    {
        $ruangans = Ruangan::all();
        $jenisRuangans = JenisRuangan::all();
        $barangs = Barang::all();
        return view('penempatans.create', compact('jenisRuangans', 'ruangans', 'barangs'));
    }

    public function store(Request $request)
    {
        // Tambahkan data penempatan baru
        Penempatan::create($request->all());

        // Kurangi jumlah barang yang tersedia di tabel barang
        $barang = Barang::findOrFail($request->barang_id);
        $barang->jumlah -= $request->jumlah;
        $barang->save();

        return redirect()->route('penempatans.index')->with('success', 'Penempatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penempatan = Penempatan::findOrFail($id);
        $ruangans = Ruangan::all();
        $jenisRuangans = JenisRuangan::all();
        $barangs = Barang::all();
        return view('penempatans.edit', compact('penempatan', 'ruangans', 'barangs', 'jenisRuangans'));
    }

    public function update(Request $request, $id)
    {
        $penempatan = Penempatan::findOrFail($id);

        // Hitung selisih jumlah barang sebelum dan setelah diupdate
        $selisihJumlah = $penempatan->jumlah - $request->jumlah;

        // Update data penempatan dengan data baru dari form
        $penempatan->update($request->all());

        if ($selisihJumlah != 0) {
            $barang = Barang::findOrFail($penempatan->barang_id);
            $barang->jumlah -= $selisihJumlah;
            $barang->save();
        }

        return redirect()->route('penempatans.index')->with('success', 'Penempatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penempatan = Penempatan::findOrFail($id);

        // Tambahkan jumlah barang yang dikembalikan ke tabel barang
        $barang = Barang::findOrFail($penempatan->barang_id);
        $barang->jumlah += $penempatan->jumlah;
        $barang->save();

        $penempatan->delete();

        return redirect()->route('penempatans.index')->with('success', 'Penempatan berhasil dihapus.');
    }
}

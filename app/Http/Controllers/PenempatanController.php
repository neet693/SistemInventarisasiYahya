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
        // Buat penempatan barang baru dengan data yang diterima
        Penempatan::create($request->all());

        // Temukan barang yang sesuai dengan penempatan
        $barang = Barang::findOrFail($request->barang_id);

        // Kurangi jumlah barang yang tersedia sesuai dengan jumlah penempatan
        $barang->jumlah -= $request->jumlah_ditempatkan;
        $barang->save();

        return redirect()->route('penempatans.index')->with('success', 'Penempatan berhasil ditambahkan.');
    }

    public function edit($barang_id)
    {
        $penempatan = Penempatan::where('barang_id', $barang_id)->first();

        if (!$penempatan) {
            // Handle jika penempatan tidak ditemukan
            return redirect()->route('penempatans.index')->with('error', 'Penempatan tidak ditemukan.');
        }
        $ruangans = Ruangan::all();
        $jenisRuangans = JenisRuangan::all();
        $barangs = Barang::all();
        return view('penempatans.edit', compact('penempatan', 'ruangans', 'barangs', 'jenisRuangans'));
    }


    public function update(Request $request, $barang_id)
    {
        // Temukan penempatan berdasarkan barang_id
        $penempatan = Penempatan::where('barang_id', $barang_id)->first();

        if (!$penempatan) {
            // Handle jika penempatan tidak ditemukan
            return redirect()->route('penempatans.index')->with('error', 'Penempatan tidak ditemukan.');
        }

        // Temukan barang yang sesuai dengan penempatan
        $barang = Barang::findOrFail($penempatan->barang_id);

        // Hitung selisih jumlah barang yang baru dengan jumlah yang sebelumnya
        $selisihJumlah = $request->jumlah - $penempatan->jumlah_ditempatkan;

        // Update data penempatan dengan data baru dari form
        $penempatan->update($request->all());

        // Sesuaikan jumlah barang dengan selisih jumlah yang baru
        $barang->jumlah += $selisihJumlah;

        // Simpan perubahan pada barang
        $barang->save();

        return redirect()->route('penempatans.index')->with('success', 'Penempatan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $penempatan = Penempatan::findOrFail($id);

        // Tambahkan jumlah barang yang dikembalikan ke tabel barang
        $barang = Barang::findOrFail($penempatan->barang_id);
        $barang->jumlah += $penempatan->jumlah_ditempatkan;
        $barang->save();

        $penempatan->delete();

        return redirect()->route('penempatans.index')->with('success', 'Penempatan berhasil dihapus.');
    }
}

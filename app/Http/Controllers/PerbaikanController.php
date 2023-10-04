<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penempatan;
use App\Models\Perbaikan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    // Menampilkan daftar semua perbaikan barang
    public function index()
    {
        $perbaikans = Perbaikan::all();
        return view('perbaikans.index', compact('perbaikans'));
    }

    // Menampilkan formulir untuk membuat perbaikan barang baru
    public function create()
    {
        $barangs = Barang::all();
        $penempatans = Penempatan::all();
        $uniqueRuangans = Penempatan::select('kode_ruangan')
            ->distinct()
            ->get();

        // Temukan detail ruangan berdasarkan ruangan_id
        $ruangans = Ruangan::whereIn('kode_ruangan', $uniqueRuangans->pluck('kode_ruangan'))->get();

        return view('perbaikans.create', compact('barangs', 'penempatans', 'ruangans'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'barang_id' => 'required|integer|exists:barangs,id',
            'jumlah_perbaikan' => 'required|integer',
            'is_selesai' => 'boolean',
            // Anda dapat menambahkan validasi lain sesuai kebutuhan
        ]);

        // Buat perbaikan barang baru dengan data yang diterima
        $perbaikan = Perbaikan::create($request->all());

        if ($request->is_selesai) {
            // Jika perbaikan langsung selesai saat dibuat
            $penempatan = Penempatan::where('barang_id', $request->barang_id)->first();
            if ($penempatan) {
                // Tambahkan jumlah perbaikan ke jumlah barang yang tersedia
                if ($penempatan->barang_id == $penempatan->barang_id) {
                    $penempatan->jumlah_ditempatkan -= $request->jumlah_perbaikan;
                }
                $penempatan->save();
            }
        }

        // Redirect ke halaman daftar perbaikan dengan pesan sukses
        return redirect()->route('perbaikans.index')->with('success', 'Perbaikan berhasil ditambahkan.');
    }

    // Menampilkan detail perbaikan barang
    public function show($id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        return view('perbaikans.show', compact('perbaikan'));
    }

    // Menampilkan formulir untuk mengedit perbaikan barang
    public function edit($id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $barangs = Barang::all();
        $penempatans = Penempatan::all();
        return view('perbaikans.edit', compact('perbaikan', 'penempatans', 'barangs'));
    }

    // Menyimpan perubahan data perbaikan barang ke dalam database
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'barang_id' => 'required|integer|exists:barangs,id',
            'jumlah_perbaikan' => 'required|integer',
            'is_selesai' => 'boolean',
            // Anda dapat menambahkan validasi lain sesuai kebutuhan
        ]);

        // Temukan perbaikan barang yang akan diperbarui berdasarkan ID
        $perbaikan = Perbaikan::findOrFail($id);

        // Simpan jumlah perbaikan sebelum diperbarui
        $jumlahSebelum = $perbaikan->jumlah_perbaikan;

        // Update data perbaikan barang dengan data yang diterima
        $perbaikan->update($request->all());

        // Hitung selisih jumlah perbaikan sebelum dan setelah diperbarui
        $selisihJumlah = $jumlahSebelum - $request->jumlah_perbaikan;

        // Temukan barang yang sesuai dengan perbaikan
        $barang = Barang::findOrFail($request->barang_id);

        // Jika selisih jumlah tidak nol, kurangi jumlah barang dan simpan perubahan
        if ($selisihJumlah != 0) {
            $barang->jumlah += $selisihJumlah;
            $barang->save();
        }

        // Redirect ke halaman daftar perbaikan dengan pesan sukses
        return redirect()->route('perbaikans.index')->with('success', 'Perbaikan berhasil diperbarui.');
    }

    // Menghapus perbaikan barang dari database
    public function destroy($id)
    {
        // Temukan perbaikan barang yang akan dihapus berdasarkan ID
        $perbaikan = Perbaikan::findOrFail($id);

        // Temukan barang yang sesuai dengan perbaikan
        $barang = Barang::findOrFail($perbaikan->barang_id);

        // Tambahkan jumlah barang perbaikan yang dihapus kembali ke jumlah yang tersedia
        $barang->jumlah += $perbaikan->jumlah_perbaikan;
        $barang->save();

        // Hapus perbaikan barang dari database
        $perbaikan->delete();

        // Redirect ke halaman daftar perbaikan dengan pesan sukses
        return redirect()->route('perbaikans.index')->with('success', 'Perbaikan berhasil dihapus.');
    }
}

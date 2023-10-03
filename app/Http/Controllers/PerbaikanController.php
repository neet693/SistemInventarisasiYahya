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

    // Menyimpan perbaikan barang baru ke dalam database
    public function store(Request $request)
    {

        // Buat perbaikan barang baru dengan data yang diterima
        Perbaikan::create($request->all());

        // Temukan penempatan yang sesuai dengan barang yang diterima
        $penempatan = Penempatan::where('kode_barang', $request->kode_barang)->first();

        if ($penempatan) {
            // Kurangkan jumlah barang yang ditempatkan sesuai dengan jumlah perbaikan
            $penempatan->jumlah_ditempatkan -= $request->jumlah_perbaikan;
            $penempatan->save();
        }
        // Jika perbaikan langsung selesai saat dibuat
        if ($request->is_selesai) {
            // Tambahkan jumlah perbaikan ke jumlah barang
            $penempatan->jumlah_ditempatkan -= $request->jumlah_perbaikan;
            $penempatan->save();
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
        return view('perbaikans.edit', compact('perbaikan', 'barangs'));
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

        // Tambahkan jumlah barang yang telah dihapus kembali ke jumlah yang tersedia
        $barang->jumlah += $perbaikan->jumlah_perbaikan;
        $barang->save();

        // Hapus perbaikan barang dari database
        $perbaikan->delete();

        // Redirect ke halaman daftar perbaikan dengan pesan sukses
        return redirect()->route('perbaikans.index')->with('success', 'Perbaikan berhasil dihapus.');
    }
}

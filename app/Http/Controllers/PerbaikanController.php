<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penempatan;
use App\Models\Perbaikan;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    // Menampilkan daftar semua perbaikan barang
    public function index()
    {
        $perbaikans = Perbaikan::all();
        $users = User::all();
        return view('perbaikans.index', compact('perbaikans', 'users'));
    }

    // Menampilkan formulir untuk membuat perbaikan barang baru
    public function create()
    {
        $ruangans = Ruangan::all();
        $barangs = Barang::all();
        $users = User::all();

        return view('perbaikans.create', compact('ruangans', 'barangs', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'no_tiket_perbaikan' => 'required',
            'ruangan_id' => 'required|integer|exists:ruangans,id',
            'barang_id' => 'required|integer|exists:barangs,id',
            'tanggal_kerusakan' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            'penanggung_jawab_id' => 'required|integer|exists:users,id',
            'jumlah_perbaikan' => 'required|integer',
            // Anda dapat menambahkan validasi lain sesuai kebutuhan
        ]);

        // Temukan barang yang diperbaiki
        $barang = Barang::findOrFail($request->barang_id);

        // Pastikan jumlah perbaikan tidak melebihi jumlah barang yang tersedia
        if ($request->jumlah_perbaikan > $barang->jumlah) {
            return redirect()->back()->with('error', 'Jumlah perbaikan melebihi jumlah barang yang tersedia.');
        }

        // Buat perbaikan barang baru dengan data yang diterima
        $perbaikan = new Perbaikan();
        $request->validate($perbaikan->rules());
        $perbaikan->no_tiket_perbaikan = $request->no_tiket_perbaikan;
        $perbaikan->ruangan_id = $request->ruangan_id;
        $perbaikan->barang_id = $request->barang_id;
        $perbaikan->tanggal_kerusakan = $request->tanggal_kerusakan;
        $perbaikan->status = $request->status;
        $perbaikan->keterangan = $request->keterangan;
        $perbaikan->penanggung_jawab_id = $request->penanggung_jawab_id;
        $perbaikan->jumlah_perbaikan = $request->jumlah_perbaikan;
        $perbaikan->save();

        // Kurangkan jumlah barang yang rusak dari jumlah yang tersedia
        $barang->jumlah -= $request->jumlah_perbaikan;
        $barang->save();

        redirect()->back()->with('success', 'Perbaikan berhasil ditambahkan');
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
        $barangs = Barang::all();
        $perbaikan = Perbaikan::findOrFail($id);
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

        // Tambahkan jumlah barang perbaikan yang dihapus kembali ke jumlah yang tersedia
        $barang->jumlah += $perbaikan->jumlah_perbaikan;
        $barang->save();

        // Hapus perbaikan barang dari database
        $perbaikan->delete();

        // Redirect ke halaman daftar perbaikan dengan pesan sukses
        return redirect()->route('perbaikans.index')->with('success', 'Perbaikan berhasil dihapus.');
    }
}

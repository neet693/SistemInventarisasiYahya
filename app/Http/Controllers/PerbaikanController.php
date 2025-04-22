<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penempatan;
use App\Models\Perbaikan;
use App\Models\Ruangan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    // Menampilkan daftar semua perbaikan barang
    public function index()
    {
        $perbaikanBarang = Perbaikan::all();
        $users = User::all();
        return view('perbaikans.index', compact('perbaikanBarang', 'users'));
    }

    // Menampilkan formulir untuk membuat perbaikan barang baru
    public function create()
    {
        $units = Unit::all();
        $ruangans = Ruangan::all();
        $barangs = Barang::all();
        $users = User::all();

        return view('perbaikans.create', compact('units', 'ruangans', 'barangs', 'users'));
    }


    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'unit_id' => 'required|integer|exists:units,id',
            'ruangan_id' => 'required|integer|exists:ruangans,id',
            'barang_id' => 'required|array',  // Menggunakan array jika banyak barang
            'barang_id.*' => 'integer|exists:barangs,id',  // Validasi setiap id barang
            'tanggal_kerusakan' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            'penanggung_jawab_id' => 'required|integer|exists:users,id',
        ]);

        // Generate nomor tiket otomatis
        $prefix = 'P'; // Prefix yang ditentukan
        // Cari nomor tiket terakhir berdasarkan prefix
        $lastTiket = Perbaikan::where('no_tiket_perbaikan', 'like', $prefix . '-%')
            ->orderByDesc('no_tiket_perbaikan')
            ->first();

        // Jika ada tiket sebelumnya, ambil nomor terakhir dan increment
        if ($lastTiket) {
            // Ambil angka terakhir dari nomor tiket
            $lastNumber = (int) substr($lastTiket->no_tiket_perbaikan, strlen($prefix) + 1); // Mengambil angka dari nomor tiket
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);  // Increment dan pastikan 3 digit
        } else {
            // Jika tidak ada tiket sebelumnya, mulai dari 001
            $nextNumber = '001';
        }

        // Gabungkan prefix dan nomor tiket yang baru
        $noTiketPerbaikan = $prefix . '-' . $nextNumber;

        // Cek untuk memastikan tidak ada duplikasi
        while (Perbaikan::where('no_tiket_perbaikan', $noTiketPerbaikan)->exists()) {
            // Jika nomor tiket sudah ada, increment nomor tiket
            $nextNumber = str_pad((int) $nextNumber + 1, 3, '0', STR_PAD_LEFT); // Increment lagi
            $noTiketPerbaikan = $prefix . '-' . $nextNumber;
        }

        // Proses perbaikan untuk setiap barang
        foreach ($request->barang_id as $barangId) {
            // Buat perbaikan barang baru dengan data yang diterima
            $perbaikan = new Perbaikan();
            $perbaikan->no_tiket_perbaikan = $noTiketPerbaikan; // Gunakan tiket yang sudah dihitung
            $perbaikan->unit_id = $request->unit_id;
            $perbaikan->ruangan_id = $request->ruangan_id;
            $perbaikan->barang_id = $barangId;
            $perbaikan->tanggal_kerusakan = $request->tanggal_kerusakan;
            $perbaikan->status = $request->status;
            $perbaikan->keterangan = $request->keterangan;
            $perbaikan->penanggung_jawab_id = $request->penanggung_jawab_id;
            $perbaikan->save();

            // Temukan barang yang diperbaiki dan rubah kondisi
            $barang = Barang::findOrFail($barangId);
            $barang->kondisi = 'Butuh Perbaikan';
            $barang->save();
        }

        // Ambil semua perbaikan setelah penyimpanan
        $perbaikanBarang = Perbaikan::with(['ruangan', 'barang', 'penanggungjawab'])->get();

        // Redirect ke index dengan data perbaikan
        return view('perbaikans.index')->with('perbaikanBarang', $perbaikanBarang)->with('success', 'Perbaikan berhasil ditambahkan.');
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
        // Update data perbaikan barang dengan data yang diterima
        $perbaikan->update($request->all());

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
        $barang->save();

        // Hapus perbaikan barang dari database
        $perbaikan->delete();

        // Redirect ke halaman daftar perbaikan dengan pesan sukses
        return redirect()->route('perbaikans.index')->with('success', 'Perbaikan berhasil dihapus.');
    }
}

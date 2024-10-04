<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Unit;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Tampilkan daftar peminjaman
        $peminjamans = Peminjaman::with('barang')->get();
        return view('peminjamans.index', compact('peminjamans'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat peminjaman baru
        $barangs = Barang::all();
        $units = Unit::all();
        return view('peminjamans.create', compact('barangs', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required|string|max:255',
            'nama_asesor' => 'required|string|max:255',
            'nama_penerima' => 'nullable|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        // Validasi stok barang
        $barang = Barang::findOrFail($request->input('barang_id'));
        if ($barang->jumlah < $request->input('jumlah')) {
            return redirect()->back()->with('error', 'Stok barang tidak mencukupi.');
        }

        // Membuat peminjaman
        Peminjaman::create([
            'no_tiket_peminjaman' => uniqid(),
            'barang_id' => $request->input('barang_id'),
            'unit_id' => $request->input('unit_id'), // Pastikan Anda menyimpan unit_id
            'nama_peminjam' => $request->input('nama_peminjam'),
            'nama_asesor' => $request->input('nama_asesor'),
            'nama_penerima' => $request->input('nama_penerima'),
            'tanggal_pinjam' => $request->input('tanggal_pinjam'),
            'tanggal_kembali' => $request->input('tanggal_kembali'),
            'jumlah' => $request->input('jumlah'),
            'status_peminjaman' => 'Dipinjamkan',
            'catatan' => $request->input('catatan'), // Menyimpan catatan jika ada
        ]);

        // Mengurangkan stok barang
        $barang->update(['jumlah' => $barang->jumlah - $request->input('jumlah')]);

        return redirect()->route('peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjamans.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function kembalikan(Request $request, Peminjaman $peminjaman)
    {
        // Validasi nama penerima
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
        ]);

        if ($peminjaman->status_peminjaman === 'Dipinjamkan') {
            $peminjaman->update([
                'status_peminjaman' => 'Dikembalikan',
                'tanggal_kembali' => now(),
                'penerima_id' => auth()->user()->id,
                'nama_penerima' => $request->input('nama_penerima'), // Simpan nama penerima
            ]);

            // Menambahkan stok barang sesuai jumlah yang dikembalikan
            $barang = $peminjaman->barang;
            $barang->update(['jumlah' => $barang->jumlah + $peminjaman->jumlah]);

            return redirect()->route('peminjamans.index')
                ->with('success', 'Barang berhasil dikembalikan.');
        } else {
            return redirect()->back()->with('error', 'Peminjaman tidak dapat dikembalikan.');
        }
    }
}

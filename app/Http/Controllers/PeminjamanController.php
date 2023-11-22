<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
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
        return view('peminjamans.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required',
            'tanggal_pinjam' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
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
            'nama_peminjam' => $request->input('nama_peminjam'),
            'tanggal_pinjam' => $request->input('tanggal_pinjam'),
            'jumlah' => $request->input('jumlah'),
            'status_peminjaman' => 'Dipinjamkan',
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

    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status_peminjaman === 'Dipinjamkan') {
            $peminjaman->update([
                'status_peminjaman' => 'Dikembalikan',
                'tanggal_kembali' => now(),
                'penerima_id' => auth()->user()->id,
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

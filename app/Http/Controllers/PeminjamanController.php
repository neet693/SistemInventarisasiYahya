<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('barang')->get();
        return view('peminjamans.index', compact('peminjamans'));
    }

    public function create()
    {
        $barangs = Barang::whereNotIn('kondisi', ['Rusak', 'Butuh Perbaikan', 'Dipinjamkan'])->get();
        $units = Unit::all();
        return view('peminjamans.create', compact('barangs', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required|string|max:255',
            'nama_asesor' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        // Validasi stok barang
        $barang = Barang::findOrFail($request->input('barang_id'));
        if ($barang->kondisi === 'Dipinjamkan') {
            return redirect()->back()->with('error', 'Barang ini sedang dipinjam dan belum dikembalikan.');
        }

        // Membuat peminjaman
        Peminjaman::create([
            'no_tiket_peminjaman' => uniqid(),
            'barang_id' => $request->input('barang_id'),
            'unit_id' => $request->input('unit_id'),
            'nama_peminjam' => $request->input('nama_peminjam'),
            'nama_asesor' => $request->input('nama_asesor'),
            'tanggal_pinjam' => $request->input('tanggal_pinjam'),
            'status_peminjaman' => 'Dipinjamkan',
            'catatan' => $request->input('catatan'),
        ]);

        // Mengurangkan stok barang
        $barang->unit_id = $request->input('unit_id');
        $barang->kondisi = 'Dipinjamkan';
        $barang->save();


        return redirect()->route('peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

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

            $barang = $peminjaman->barang;
            $barang->kondisi = 'Baik';
            $barang->save();

            return redirect()->route('peminjamans.index')
                ->with('success', 'Barang berhasil dikembalikan.');
        } else {
            return redirect()->back()->with('error', 'Peminjaman tidak dapat dikembalikan.');
        }
    }

    // Verifikasi password untuk peminjaman
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        // Cek apakah password yang dimasukkan sesuai dengan yang ada di .env
        if (Hash::check($request->password, env('PINJAMAN_PASSWORD'))) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error'], 401);
        }
    }
}

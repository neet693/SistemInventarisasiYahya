<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Jika admin, tampilkan semua peminjaman
        if (auth()->check() && auth()->user()->isAdmin()) {
            $peminjamans = Peminjaman::all();
        } else {
            // Jika tidak login atau bukan admin, tampilkan peminjaman yang sesuai dengan unit yang dipinjamkan
            $unit_id = auth()->user()->unit_id ?? null;
            $peminjamans = Peminjaman::whereHas('barang', function ($query) use ($unit_id) {
                if ($unit_id) {
                    $query->where('unit_id', $unit_id);
                }
            })->get();
        }

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
            'barang_id' => 'required|array',  // Barang bisa banyak
            'barang_id.*' => 'exists:barangs,id', // Validasi masing-masing barang
            'nama_peminjam' => 'required|string|max:255',
            'nama_asesor' => 'required|string|max:255',
            'tanggal_pinjam' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        // Untuk setiap barang yang dipilih, kita akan membuat peminjaman
        foreach ($request->barang_id as $barangId) {
            $barang = Barang::findOrFail($barangId);

            // Validasi stok barang
            if ($barang->kondisi === 'Dipinjamkan') {
                return redirect()->back()->with('error', 'Barang ' . $barang->nama . ' sedang dipinjam.');
            }

            // Membuat peminjaman untuk setiap barang
            Peminjaman::create([
                'barang_id' => $barangId,
                'unit_id' => $request->input('unit_id'),  // Unit peminjam
                'nama_peminjam' => $request->input('nama_peminjam'),
                'nama_asesor' => $request->input('nama_asesor'),
                'tanggal_pinjam' => $request->input('tanggal_pinjam'),
                'status_peminjaman' => 'Dipinjamkan',
                'catatan' => $request->input('catatan'),
            ]);

            // Mengurangkan stok barang
            $barang->kondisi = 'Dipinjamkan';
            $barang->save();
        }

        return redirect()->route('peminjamans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function updateAcc(Request $request, Peminjaman $peminjaman)
    {
        // Validasi
        $request->validate([
            'acc_peminjaman' => 'required|in:pending,approved,rejected',
            'alasan_tidak_acc' => 'nullable|string|max:255',
        ]);

        // Update status ACC dan alasan jika rejected
        $peminjaman->update([
            'acc_peminjaman' => $request->acc_peminjaman,
            'alasan_tidak_acc' => $request->acc_peminjaman === 'rejected' ? $request->alasan_tidak_acc : null,
        ]);

        return redirect()->route('peminjamans.index')->with('success', 'Status ACC peminjaman berhasil diperbarui.');
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

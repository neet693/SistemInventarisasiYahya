<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penempatan;
use App\Models\Perbaikan;
use App\Models\StatusPerbaikan;
use Illuminate\Http\Request;

class StatusPerbaikanController extends Controller
{
    public function index()
    {
        $statusPerbaikans = StatusPerbaikan::all();
        return view('status_perbaikans.index', compact('statusPerbaikans'));
    }

    public function create()
    {
        $perbaikans = Perbaikan::all();
        return view('status_perbaikans.create', compact('perbaikans'));;
    }

    public function store(Request $request)
    {
        // Temukan status perbaikan yang akan disimpan
        $statusPerbaikan = StatusPerbaikan::create($request->all());

        // Temukan perbaikan yang sesuai dengan nomor tiket perbaikan yang ada
        $perbaikan = Perbaikan::where('no_tiket_perbaikan', $request->no_tiket_perbaikan)->first();

        // Periksa apakah perbaikan ada dan belum dihapus
        if ($perbaikan && !$perbaikan->trashed()) {
            // Ambil data barang berdasarkan id barang yang diperbaiki
            $barang = Barang::find($perbaikan->barang_id);

            if ($statusPerbaikan->status === 'Selesai') {
                // Jika status perbaikan adalah "Selesai", kembalikan jumlah barang ke jumlah awal
                $barang->jumlah += $request->jumlah_perbaikan;
                $perbaikan->is_selesai = true;
            } elseif ($statusPerbaikan->status === 'Dalam Proses') {
                // Jika status perbaikan adalah "Dalam Proses", tandai perbaikan sebagai tidak selesai
                $barang->jumlah -= $request->jumlah_perbaikan;
                $perbaikan->is_selesai = false;
            }

            // Simpan perubahan pada barang
            $barang->save();
            // Simpan perubahan pada status perbaikan
            $perbaikan->save();
        }

        // Redirect dengan pesan sukses
        return redirect()->route('status_perbaikans.index')->with('success', 'Data status perbaikan berhasil ditambahkan.');
    }


    public function show($id)
    {
        $statusPerbaikan = StatusPerbaikan::find($id);
        return view('status_perbaikans.show', compact('statusPerbaikan'));
    }

    public function edit($id)
    {
        $perbaikans = Perbaikan::all();
        $statusPerbaikan = StatusPerbaikan::findOrFail($id);
        // $statusPerbaikan = StatusPerbaikan::find($id);
        return view('status_perbaikans.edit', compact('statusPerbaikan', 'perbaikans'));
    }

    public function update(Request $request, $id)
    {

        // Temukan status perbaikan yang akan diperbarui berdasarkan ID
        $statusPerbaikan = StatusPerbaikan::findOrFail($id);

        // Pastikan status perbaikan diubah menjadi "Selesai"
        if ($request->status === 'Selesai') {
            // Temukan perbaikan yang sesuai dengan status perbaikan ini
            $perbaikan = Perbaikan::where('no_tiket_perbaikan', $statusPerbaikan->no_tiket_perbaikan)->first();

            // Jika perbaikan ditemukan dan is_selesai belum diatur menjadi true
            if ($perbaikan && !$perbaikan->is_selesai) {
                // Mengembalikan jumlah barang yang rusak
                $barang = Barang::findOrFail($perbaikan->barang_id);
                $barang->jumlah += $perbaikan->jumlah_perbaikan;
                $barang->save();

                // Hapus perbaikan dari daftar perbaikan
                $perbaikan->delete();

                // Setel is_selesai menjadi true
                $perbaikan->is_selesai = true;
                $perbaikan->save();
            }
        }

        // Update data status perbaikan
        $statusPerbaikan->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'tanggal_selesai' => now(), // Tanggal selesai diatur menjadi saat ini
        ]);

        // Redirect ke halaman daftar status perbaikan dengan pesan sukses
        return redirect()->route('status-perbaikans.index')->with('success', 'Status perbaikan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $statusPerbaikan = StatusPerbaikan::findOrFail($id);
        $statusPerbaikan->delete();
        return redirect()->route('status_perbaikans.index')->with('success', 'Data status perbaikan berhasil dihapus.');
    }
}

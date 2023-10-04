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
        $statusPerbaikan = StatusPerbaikan::create($request->all());

        // Ambil data perbaikan berdasarkan nomor tiket perbaikan
        $perbaikan = Perbaikan::where('no_tiket_perbaikan', $request->no_tiket_perbaikan)->first();

        // Ambil data barang berdasarkan id barang yang diperbaiki
        $barang = Barang::find($perbaikan->barang_id);

        if ($statusPerbaikan->status === 'Selesai') {
            // Jika status perbaikan adalah "Selesai", kembalikan jumlah barang ke jumlah awal
            $barang->jumlah += $request->jumlah_perbaikan;

            // Simpan perubahan jumlah barang
            $barang->save();
        }

        if ($statusPerbaikan->status === 'Selesai') {
            // Jika status perbaikan adalah "Selesai", tandai perbaikan sebagai selesai
            $perbaikan->is_selesai = true;

            // Simpan perubahan status perbaikan
            $perbaikan->save();
        } elseif ($statusPerbaikan->status === 'Dalam Proses') {
            // Jika status perbaikan adalah "Dalam Proses", tandai perbaikan sebagai tidak selesai
            $perbaikan->is_selesai = false;

            // Simpan perubahan status perbaikan
            $perbaikan->save();
        }

        // Hitung ulang jumlah total barang yang tersedia
        // $totalTersedia = $this->hitungJumlahBarangTersedia();

        return redirect()->route('status_perbaikans.index')->with('success', 'Data status perbaikan berhasil ditambahkan.')->with('totalTersedia', $totalTersedia);
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
        $statusPerbaikan = StatusPerbaikan::findOrFail($id);
        $statusSebelumnya = $statusPerbaikan->status;

        // Update data status perbaikan dengan data baru dari form
        $statusPerbaikan->update($request->all());

        // Periksa apakah status sebelumnya bukan "Selesai" dan status saat ini adalah "Selesai"
        if ($statusSebelumnya != 'Selesai' && $statusPerbaikan->status == 'Selesai') {
            $perbaikan = Perbaikan::where('no_tiket_perbaikan', $statusPerbaikan->no_tiket_perbaikan)->first();

            if ($perbaikan) {
                $penempatan = Penempatan::findOrFail($perbaikan->barang_id);

                // Perbarui jumlah penempatan jika ada
                $penempatan->jumlah_ditempatkan += $perbaikan->jumlah_perbaikan;
                $penempatan->save();
            }
        }

        // Jika status perbaikan selesai, ubah boolean is_selesai pada Perbaikan menjadi true
        if ($statusPerbaikan->status === 'Selesai') {
            $perbaikan = Perbaikan::where('no_tiket_perbaikan', $statusPerbaikan->no_tiket_perbaikan)->first();

            if ($perbaikan) {
                $perbaikan->is_selesai = true;
                $penempatan->jumlah_ditempatkan += $perbaikan->jumlah_perbaikan;
                $perbaikan->save();
            }
        }

        return redirect()->route('status_perbaikans.index')->with('success', 'Data status perbaikan berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $statusPerbaikan = StatusPerbaikan::findOrFail($id);
        $statusPerbaikan->delete();
        return redirect()->route('status_perbaikans.index')->with('success', 'Data status perbaikan berhasil dihapus.');
    }
}

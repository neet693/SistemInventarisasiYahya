<?php

namespace App\Http\Controllers;

use App\Models\Barang;
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
        $barang = Barang::findOrFail($perbaikan->barang_id);

        if ($statusPerbaikan->kondisi === 'Baik') {
            // Jika kondisi barang diperbaikan adalah "Baik", tambahkan kembali jumlah barang yang diperbaiki ke jumlah barang yang ada
            $barang->jumlah += $perbaikan->jumlah;
        } elseif ($statusPerbaikan->kondisi === 'Rusak') {
            // Jika kondisi barang diperbaikan adalah "Rusak", kurangi jumlah barang yang diperbaiki dari jumlah barang yang ada
            $barang->jumlah -= $perbaikan->jumlah;
        }

        $barang->save();
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
        $statusPerbaikan = StatusPerbaikan::findOrFail($id);
        $statusSebelumnya = $statusPerbaikan->status;

        // Update data status perbaikan dengan data baru dari form
        $statusPerbaikan->update($request->all());

        // Jika status perbaikan sebelumnya bukan 'Selesai', maka kita perlu mengubah jumlah barang
        if ($statusSebelumnya != 'Selesai' && $statusPerbaikan->status == 'Selesai') {
            $perbaikan = Perbaikan::where('no_tiket_perbaikan', $statusPerbaikan->no_tiket_perbaikan)->first();
            $barang = Barang::findOrFail($perbaikan->barang_id);
            $barang->jumlah += $perbaikan->jumlah;
            $barang->save();
        }

        // Jika status perbaikan selesai, ubah boolean is_selesai pada Perbaikan menjadi true
        if ($statusPerbaikan->status === 'Selesai') {
            $perbaikan = Perbaikan::where('no_tiket_perbaikan', $statusPerbaikan->no_tiket_perbaikan)->first();
            if ($perbaikan) {
                $perbaikan->is_selesai = true;
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

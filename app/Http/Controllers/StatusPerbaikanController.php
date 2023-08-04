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
        StatusPerbaikan::create($request->all());
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
        $statusPerbaikan->update($request->all());
        $perbaikan = Perbaikan::where('no_tiket_perbaikan', $statusPerbaikan->no_tiket_perbaikan)->first();

        // If the kondisi is 'Baik', add back the damaged items
        if ($request->kondisi === 'Baik' && $perbaikan) {
            $barang = Barang::findOrFail($perbaikan->barang_id);
            $barang->jumlah += $perbaikan->jumlah;
            $barang->save();
        }

        // If the kondisi is 'Rusak', subtract the damaged items
        if ($request->kondisi === 'Rusak' && $perbaikan) {
            $barang = Barang::findOrFail($perbaikan->barang_id);
            $barang->jumlah -= $perbaikan->jumlah;
            $barang->save();
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

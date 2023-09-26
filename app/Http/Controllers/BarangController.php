<?php

namespace App\Http\Controllers;

use App\Exports\BarangsExport;
use App\Imports\BarangsImport;
use App\Models\Barang;
use App\Models\JenisPengadaan;
use App\Models\Kategorial;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barangs.index', compact('barangs'));
    }

    public function create()
    {
        $ruangans = Ruangan::all();
        $jenis_pengadaans = JenisPengadaan::all();
        $kategorials = Kategorial::all(); // Tambahkan ini untuk mendapatkan data kategorial
        return view('barangs.create', compact('ruangans', 'jenis_pengadaans', 'kategorials'));
    }

    public function store(Request $request)
    {
        Barang::create($request->all());
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        return view('barangs.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $ruangans = Ruangan::all();
        $jenis_pengadaans = JenisPengadaan::all();
        $kategorials = Kategorial::all(); // Tambahkan ini untuk mendapatkan data kategorial
        return view('barangs.edit', compact('barang', 'ruangans', 'jenis_pengadaans', 'kategorials'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        // Simpan jumlah barang sebelum diupdate
        $jumlahSebelum = $barang->jumlah;

        $barang->update($request->all());

        // Hitung selisih jumlah barang sebelum dan setelah diupdate
        $selisihJumlah = $jumlahSebelum - $request->jumlah;

        if ($selisihJumlah != 0) {
            $barang->jumlah -= $selisihJumlah;
            $barang->save();
        }
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function import()
    {
        Excel::import(new BarangsImport, request()->file('your_file'));

        return redirect('/')->with('success', 'All good!');
    }

    public function export()
    {
        return Excel::download(new BarangsExport, 'barangs.xlsx');
    }
}

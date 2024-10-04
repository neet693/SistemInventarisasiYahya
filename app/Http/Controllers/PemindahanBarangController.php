<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PemindahanBarang;
use App\Models\Ruangan;
use App\Models\Unit;
use Illuminate\Http\Request;

class PemindahanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemindahans = PemindahanBarang::all();
        return view('pemindahan.index', compact('pemindahans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all();
        $units = Unit::all();
        $ruangans = Ruangan::all();
        return view('pemindahan.create', compact('barangs', 'units', 'ruangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'unit_asal_id' => 'required|exists:units,id',
            'unit_tujuan_id' => 'required|exists:units,id',
            'ruangan_asal_id' => 'required|exists:ruangans,id',
            'ruangan_tujuan_id' => 'required|exists:ruangans,id',
            'ruangan_tujuan_id' => 'required|exists:ruangans,id',
            'tanggal_pemindahan' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable',
        ]);

        // Pastikan barang tersedia di unit dan ruangan asal
        $barang = Barang::findOrFail($request->input('barang_id'));

        if ($barang->jumlah < $request->input('jumlah')) {
            return redirect()->back()->with('error', 'Jumlah barang tidak mencukupi.');
        }

        // Kurangi stok barang di unit asal
        $barang->jumlah -= $request->jumlah;
        $barang->save();

        // Pindahkan barang
        PemindahanBarang::create($request->all());

        // Cek apakah barang sudah ada di unit tujuan
        $barangTujuan = Barang::where('kode_barang', $barang->kode_barang)
            ->where('unit_id', $request->unit_tujuan_id)
            ->first();

        if ($barangTujuan) {
            // Jika barang sudah ada, tambahkan jumlahnya
            $barangTujuan->jumlah += $request->jumlah;
            $barangTujuan->save();
        } else {
            // Jika barang belum ada, buat baru dengan jumlah yang dipindahkan
            $barangTujuan = Barang::create([
                'kode_barang' => $barang->kode_barang,
                'nama' => $barang->nama,
                'merk' => $barang->merk,
                'tipe' => $barang->tipe,
                'jumlah' => 0, // Set jumlah yang dipindahkan
                'ruangan_id' => $request->ruangan_tujuan_id,
                'unit_id' => $request->unit_tujuan_id,
            ]);
        }
        $barangTujuan->jumlah += $request->jumlah;
        $barangTujuan->save();


        return redirect()->route('pemindahan.index')->with('success', 'Barang berhasil dipindahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(PemindahanBarang $pemindahanBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PemindahanBarang $pemindahanBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PemindahanBarang $pemindahanBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PemindahanBarang $pemindahanBarang)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Barang;
use App\Models\PemindahanBarang;
use App\Models\Peminjaman;
use App\Models\Perbaikan;
use App\Models\Unit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil log aktivitas terbaru
        $logs = ActivityLog::latest()->take(5)->get();

        $barangs = Barang::with('unit')->get();
        $units = Unit::with('barangs')->get();

        foreach ($units as $unit) {
            $totalJumlah = $unit->barangs->sum('jumlah'); // Hitung total jumlah barang per unit
            $unit->total_barang = $totalJumlah; // Simpan total jumlah barang ke dalam unit
        }

        return view('homes.index', compact('barangs', 'units', 'logs'));
    }



    public function showUnit($unitName)
    {
        // Ambil unit berdasarkan nama
        $unit = Unit::where('nama', $unitName)->first();

        // Jika unit tidak ditemukan, bisa redirect atau show error
        if (!$unit) {
            abort(404); // Atau bisa ganti dengan logika lain sesuai kebutuhan
        }

        // Ambil data barang berdasarkan unit id
        $barangs = Barang::with('unit')->where('unit_id', $unit->id)->get();

        // Hitung total barang dan kondisi untuk unit yang dipilih
        $TotalBarang = Barang::where('unit_id', $unit->id)->sum('jumlah');
        $totalRusak = Barang::where('unit_id', $unit->id)->where('kondisi', 'Rusak')->sum('jumlah');
        $totalBaik = Barang::where('unit_id', $unit->id)->where('kondisi', 'Baik')->sum('jumlah');
        $JumlahTiketPerbaikan = Perbaikan::where('unit_id', $unit->id)->count('id');

        $totalDipindahkan = PemindahanBarang::sum('jumlah');
        // Hitung jumlah barang yang diperbaiki
        $totalDiperbaiki = Perbaikan::where('barang_id')->whereHas('barang', function ($query) use ($unit) {
            $query->where('unit_id', $unit->id);
        })->count('id');

        // Hitung jumlah barang yang dipinjamkan
        $totalDipinjamkan = Peminjaman::whereHas('barang', function ($query) use ($unit) {
            $query->where('unit_id', $unit->id);
        })->sum('jumlah');


        return view('homes.units.index', compact('barangs', 'unit', 'TotalBarang', 'totalRusak', 'totalBaik', 'totalDiperbaiki', 'totalDipinjamkan', 'totalDipindahkan'));
    }
}

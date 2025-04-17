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
        $units = Unit::get();

        foreach ($units as $unit) {
            $totalBarang = Barang::where('unit_id', $unit->id)->where('kondisi', 'Baik')->count(); // Jumlah barang dalam kondisi baik per unit
            $unit->total_barang_baik = $totalBarang; // Menyimpan jumlah barang baik per unit
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
        $totalBaik = Barang::where('unit_id', $unit->id)->where('kondisi', 'Baik')->count();  // Jumlah barang dalam kondisi baik
        $totalRusak = Barang::where('unit_id', $unit->id)->where('kondisi', 'Rusak')->count();
        // $totalBarang = Barang::where('unit_id', $unit->id)->count(); // Total barang
        $JumlahTiketPerbaikan = Perbaikan::where('unit_id', $unit->id)->count('id');

        $totalDipindahkan = PemindahanBarang::count();
        $totalDiperbaiki = Perbaikan::whereHas('barang', function ($query) use ($unit) {
            $query->where('unit_id', $unit->id);
        })->count();

        // Hitung jumlah barang yang dipinjamkan
        $totalDipinjamkan = Peminjaman::where('status_peminjaman', 'Dipinjamkan')
            ->whereHas('barang', function ($query) use ($unit) {
                $query->where('unit_id', $unit->id);
            })->count();

        // Kirim data ke view
        return view('homes.units.index', compact('barangs', 'unit', 'totalRusak', 'totalBaik', 'totalDiperbaiki', 'totalDipinjamkan', 'totalDipindahkan'));
    }
}

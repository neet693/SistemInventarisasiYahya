<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penempatan;
use App\Models\Perbaikan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $jumlahTotalBarang = $barangs->sum('jumlah');
        // Hitung jumlah total barang yang rusak
        $jumlahBarangRusak = Perbaikan::where('is_selesai', false)->get()->sum('jumlah');
        // Hitung jumlah total barang yang rusak
        $jumlahBarangPerbaikan = Perbaikan::all()->sum('jumlah');

        return view('homes.index', compact('barangs', 'jumlahTotalBarang', 'jumlahBarangRusak', 'jumlahBarangPerbaikan'));
    }
}

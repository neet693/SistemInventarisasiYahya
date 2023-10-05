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
        // Hitung jumlah barang tersedia sekali di awal
        $TotalBarang = Barang::sum('jumlah');
        $totalRusak = Perbaikan::where('is_selesai', false)->sum('jumlah_perbaikan');
        $JumlahTiketPerbaikan = Perbaikan::count('id');
        $barangs = Barang::all();

        return view('homes.index', compact('barangs', 'totalRusak', 'TotalBarang', 'JumlahTiketPerbaikan'));
    }
}

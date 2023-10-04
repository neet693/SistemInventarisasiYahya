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
        $barangs = Barang::all();
        $totalTersedia = Barang::sum('jumlah');
        $totalRusak = Perbaikan::where('is_selesai', false)->sum('jumlah_perbaikan');
        $totalMaintenance = Perbaikan::count('id');

        return view('homes.index', compact('barangs', 'totalTersedia', 'totalRusak', 'totalMaintenance'));
    }
}

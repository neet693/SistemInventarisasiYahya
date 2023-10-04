<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penempatan;
use App\Models\Perbaikan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // private function calculateTotalPlacementQuantity()
    // {
    //     // Mengambil jumlah barang rusak yang belum selesai
    //     $jumlahBarangRusak = Perbaikan::where('is_selesai', false)->sum('jumlah_perbaikan');

    //     // Mengambil jumlah penempatan
    //     $totalPenempatan = Penempatan::sum('jumlah_ditempatkan');

    //     // Mengurangkan jumlah barang rusak dari jumlah penempatan
    //     $totalPenempatan -= $jumlahBarangRusak;

    //     return $totalPenempatan;
    // }

    public function index()
    {
        // Hitung jumlah barang tersedia sekali di awal
        $totalTersedia = Barang::sum('jumlah');
        // $totalPenempatan = $this->calculateTotalPlacementQuantity();
        $totalRusak = Perbaikan::where('is_selesai', false)->sum('jumlah_perbaikan');
        $totalMaintenance = Perbaikan::count('id');
        $barangs = Barang::all();

        // return view('homes.index', compact('barangs', 'totalTersedia', 'totalPenempatan', 'totalRusak', 'totalMaintenance'));
        return view('homes.index', compact('barangs', 'totalTersedia', 'totalRusak', 'totalMaintenance'));
    }
}

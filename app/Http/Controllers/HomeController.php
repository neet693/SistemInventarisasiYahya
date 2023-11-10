<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Perbaikan;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Hitung jumlah barang tersedia sekali di awal
        // $TotalBarang = Barang::sum('jumlah');
        // $totalRusak = Perbaikan::where('is_selesai', false)->sum('jumlah_perbaikan');
        $totalRusak = Barang::where('kondisi', 'Rusak')->sum('jumlah');
        $totalBaik = Barang::where('kondisi', 'Baik')->sum('jumlah');
        $JumlahTiketPerbaikan = Perbaikan::count('id');

        $user = auth()->user();
        if ($user->isAdmin()) {
            $barangs = Barang::all();
            $TotalBarang = Barang::sum('jumlah');
        } else {
            $barangs = Barang::where('unit_id', $user->unit_id)->get();
            $TotalBarang = Barang::where('unit_id', $user->unit_id)->sum('jumlah');
        }
        return view('homes.index', compact('barangs', 'TotalBarang', 'totalRusak', 'totalBaik',  'JumlahTiketPerbaikan'));
        // return view('home');
    }
}

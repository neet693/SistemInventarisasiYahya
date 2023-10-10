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
        $TotalBarang = Barang::sum('jumlah');
        $totalRusak = Perbaikan::where('is_selesai', false)->sum('jumlah_perbaikan');
        $JumlahTiketPerbaikan = Perbaikan::count('id');

        $user = auth()->user();
        if ($user->isAdmin()) {
            $barangs = Barang::all();
        } else {
            $barangs = Barang::where('unit_id', $user->unit_id)->get();
        }
        return view('homes.index', compact('barangs', 'totalRusak', 'TotalBarang', 'JumlahTiketPerbaikan'));
        // return view('home');
    }
}

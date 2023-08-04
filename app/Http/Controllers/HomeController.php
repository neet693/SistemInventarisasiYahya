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
        $totalBarang = Barang::sum('jumlah');
        $totalPerbaikan = Perbaikan::sum('jumlah');
        $totalPenempatan = Penempatan::sum('jumlah');

        return view('homes.index', compact('totalBarang', 'totalPenempatan', 'totalPerbaikan'));
    }
}

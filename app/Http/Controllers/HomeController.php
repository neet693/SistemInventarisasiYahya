<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penempatan;
use App\Models\Perbaikan;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private function calculateTotalAvailabilityQuantity()
    {
        $totalTersedia = Barang::sum('jumlah');

        // Mengurangkan jumlah yang ditempatkan
        $totalTersedia -= Penempatan::sum('jumlah_ditempatkan');

        // Mengurangkan jumlah yang mengalami kerusakan
        $totalTersedia -= Perbaikan::sum('jumlah_perbaikan');

        return $totalTersedia;
    }

    // Fungsi untuk menghitung jumlah total barang rusak
    private function calculateTotalBrokeQuantity()
    {
        return Perbaikan::where('is_selesai', false)->sum('jumlah_perbaikan');
    }
    // Fungsi untuk menghitung jumlah total perbaikan
    private function calculateTotalRepairQuantity()
    {
        return Perbaikan::where('is_selesai', true)->sum('jumlah_perbaikan');
    }
    // Fungsi untuk menghitung jumlah total penempatan
    private function calculateTotalPlacementQuantity()
    {
        return Penempatan::sum('jumlah_ditempatkan');
    }
    public function index()
    {
        $totalTersedia = $this->calculateTotalAvailabilityQuantity();
        $totalPenempatan = $this->calculateTotalPlacementQuantity();
        $totalRusak = $this->calculateTotalBrokeQuantity();
        $totalMaintenance = $this->calculateTotalRepairQuantity();
        $barangs = Barang::all();
        return view('homes.index', compact('barangs', 'totalTersedia', 'totalPenempatan', 'totalRusak', 'totalMaintenance'));
    }

    public function filter(Request $request)
    {
        $query = Barang::query();

        if ($request->has('keyword')) {
            $query->where('nama', 'like', '%' . $request->input('keyword') . '%');
        }

        // Tambahkan logika penyaringan lainnya sesuai kebutuhan

        // Ambil daftar barang sesuai dengan kriteria filter
        $barangs = $query->paginate(10);

        // Hitung jumlah total barang dari seluruh data (tanpa memperhatikan hasil pencarian)
        $jumlahTotalBarang = Barang::sum('jumlah');

        // Hitung jumlah total barang yang rusak
        $jumlahBarangRusak = Perbaikan::where('is_selesai', false)->sum('jumlah_perbaikan');

        // Hitung jumlah total barang yang telah diperbaiki
        $jumlahBarangPerbaikan = Perbaikan::sum('jumlah_perbaikan');

        return view('homes.index', compact('barangs', 'jumlahTotalBarang', 'jumlahBarangRusak', 'jumlahBarangPerbaikan'));
    }
}

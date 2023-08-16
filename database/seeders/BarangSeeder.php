<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::create([
            'kode_barang' => 'B001',
            'nama' => 'Monitor',
            'merk' => 'Acer',
            'sumber_peroleh' => 'Yayasan Sekolah',
            'spesifikasi' => '24-inch Full HD',
            'tahun' => 2023,
            'kondisi' => 'Baik',
            'jumlah' => 200,
            'kategorial_id' => 1,
            'jenis_pengadaan_id' => 1,
        ]);
    }
}

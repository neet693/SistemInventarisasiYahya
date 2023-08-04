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
            'spesifikasi' => '24-inch Full HD',
            'tanggal' => '2023-07-31',
            'kondisi' => 'Baik',
            'jumlah' => 200,
            'kategorial_id' => 1,
            'jenis_pengadaan_id' => 1,
        ]);
    }
}

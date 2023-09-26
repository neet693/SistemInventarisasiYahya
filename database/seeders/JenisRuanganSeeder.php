<?php

namespace Database\Seeders;

use App\Models\JenisRuangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisRuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisRuangan::create([
            'nama' => 'Lab Komputer 1',
        ]);

        JenisRuangan::create([
            'nama' => 'Lab Komputer 2',
        ]);

        JenisRuangan::create([
            'nama' => 'Lab ICT Komputer',
        ]);

        JenisRuangan::create([
            'nama' => 'Rak Maintenance',
        ]);

        JenisRuangan::create([
            'nama' => 'Ruang Maintenance',
        ]);

        JenisRuangan::create([
            'nama' => 'Ruang Multimedia',
        ]);

        JenisRuangan::create([
            'nama' => 'Ruang Server',
        ]);

        JenisRuangan::create([
            'nama' => 'Ruang CCTV',
        ]);

        JenisRuangan::create([
            'nama' => 'Gudang IT',
        ]);

        JenisRuangan::create([
            'nama' => 'Ruang Kepala IT',
        ]);

        JenisRuangan::create([
            'nama' => 'Ruang Tata Usaha',
        ]);
        JenisRuangan::create([
            'nama' => 'Ruang Makan',
        ]);
    }
}

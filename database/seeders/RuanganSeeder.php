<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruangan::create([
            'kode_ruangan' => 'R01',
            'nama' => 'Lab SMP-SMA',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R02',
            'nama' => 'Lab SD',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R03',
            'nama' => 'Lab ICT (umum)',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R04',
            'nama' => 'Multimedia',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R05',
            'nama' => 'Server',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R06',
            'nama' => 'CCTV',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R07',
            'nama' => 'Rak Barang Maintenance',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R08',
            'nama' => 'Maintenance',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R09',
            'nama' => 'Tata Usaha',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R10',
            'nama' => 'Kepala IT',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R11',
            'nama' => 'Gudang',
            'jenis_ruangan_id' => 1,
        ]);
    }
}

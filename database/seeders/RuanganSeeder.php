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
            'kode_ruangan' => 'R001',
            'nama' => 'Ruang Kantor 1',
            'jenis_ruangan_id' => 1,
        ]);

        Ruangan::create([
            'kode_ruangan' => 'R002',
            'nama' => 'Ruang Kantor 2',
            'jenis_ruangan_id' => 1,
        ]);
    }
}

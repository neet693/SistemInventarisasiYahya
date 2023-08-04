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
            'nama' => 'Kantor',
        ]);

        JenisRuangan::create([
            'nama' => 'Ruang Meeting',
        ]);
    }
}

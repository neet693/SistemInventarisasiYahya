<?php

namespace Database\Seeders;

use App\Models\JenisPengadaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPengadaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisPengadaan::create([
            'nama' => 'Pembelian',
        ]);

        JenisPengadaan::create([
            'nama' => 'Hibah',
        ]);
    }
}

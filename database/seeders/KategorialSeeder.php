<?php

namespace Database\Seeders;

use App\Models\Kategorial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategorial::create([
            'nama' => 'Kategori 1',
        ]);

        Kategorial::create([
            'nama' => 'Kategori 2',
        ]);
    }
}

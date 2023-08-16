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
            'nama' => 'Monitor',
        ]);
        Kategorial::create([
            'nama' => 'PC',
        ]);
        Kategorial::create([
            'nama' => 'Keyboard',
        ]);
        Kategorial::create([
            'nama' => 'Mouse',
        ]);
        Kategorial::create([
            'nama' => 'Speaker',
        ]);
        Kategorial::create([
            'nama' => 'Printer',
        ]);
        Kategorial::create([
            'nama' => 'Scanner',
        ]);
        Kategorial::create([
            'nama' => 'Motherboard',
        ]);
        Kategorial::create([
            'nama' => 'RAM',
        ]);
        Kategorial::create([
            'nama' => 'UPS',
        ]);
        Kategorial::create([
            'nama' => 'Stabilizer',
        ]);
        Kategorial::create([
            'nama' => 'Stop Kontak',
        ]);
        Kategorial::create([
            'nama' => 'Kabel Listrik',
        ]);
    }
}

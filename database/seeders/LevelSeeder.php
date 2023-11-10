<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            'nama' => 'Admin',
        ]);

        Level::create([
            'nama' => 'Kepala',
        ]);

        Level::create([
            'nama' => 'Sarpras',
        ]);


        Level::create([
            'nama' => 'Teknisi',
        ]);

        Level::create([
            'nama' => 'Laboran',
        ]);
    }
}

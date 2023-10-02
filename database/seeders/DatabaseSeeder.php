<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(KategorialSeeder::class);
        // $this->call(JenisPengadaanSeeder::class);
        $this->call(JenisRuanganSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(RuanganSeeder::class);
        // $this->call(BarangSeeder::class);
        $this->call(PenempatanSeeder::class);
        $this->call(PerbaikanSeeder::class);
        $this->call(StatusPerbaikanSeeder::class);
    }
}

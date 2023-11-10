<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $this->call(LevelSeeder::class);
        $this->call(PerbaikanSeeder::class);
        $this->call(StatusPerbaikanSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RuanganSeeder::class);
    }
}

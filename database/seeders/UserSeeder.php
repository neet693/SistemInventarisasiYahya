<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@sisteminventarisyahya.com',
            'password' => Hash::make('rusakdeh'),
            'email_verified_at' => now(),
            'level_id' => 1,
            'unit_id' => null,
        ]);

        User::create([
            'nama' => 'Penanggung Jawab TK',
            'email' => 'pjtk@sisteminventarisyahya.com',
            'password' => Hash::make('pjtk1*'),
            'email_verified_at' => now(),
            'level_id' => 1,
            'unit_id' => 1,
        ]);
    }
}

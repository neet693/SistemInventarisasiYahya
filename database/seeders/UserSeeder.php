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
            'email' => 'admin@inventarisyahya.com',
            'password' => Hash::make('rusakdeh'),
            'email_verified_at' => now(),
            'level_id' => 1,
            'unit_id' => null,
        ]);

        User::create([
            'nama' => 'Sarpras TK',
            'email' => 'sarpras@tk.inventarisyahya.com',
            'password' => Hash::make('sarprastk*'),
            'email_verified_at' => now(),
            'level_id' => 3,
            'unit_id' => 1,
        ]);

        User::create([
            'nama' => 'Sarpras SD',
            'email' => 'sd@sarprasyahya.com',
            'password' => Hash::make('sarprassd*'),
            'email_verified_at' => now(),
            'level_id' => 3,
            'unit_id' => 2,
        ]);

        User::create([
            'nama' => 'Sarpras SMP',
            'email' => 'smp@sarprasyahya.com',
            'password' => Hash::make('sarprassmp*'),
            'email_verified_at' => now(),
            'level_id' => 3,
            'unit_id' => 3,
        ]);

        User::create([
            'nama' => 'Sarpras SMA',
            'email' => 'sma@sarprasyahya.com',
            'password' => Hash::make('sarprassma*'),
            'email_verified_at' => now(),
            'level_id' => 3,
            'unit_id' => 4,
        ]);

        User::create([
            'nama' => 'Sarpras Laboratorium',
            'email' => 'laboratorium@sarprasyahya.com',
            'password' => Hash::make('sarpraslab*'),
            'email_verified_at' => now(),
            'level_id' => 3,
            'unit_id' => 5,
        ]);

        User::create([
            'nama' => 'Sarpras TU Pusat',
            'email' => 'tupusat@sarprasyahya.com',
            'password' => Hash::make('sarprastu*'),
            'email_verified_at' => now(),
            'level_id' => 3,
            'unit_id' => 6,
        ]);

        User::create([
            'nama' => 'Sarpras IT',
            'email' => 'it@sarprasyahya.com',
            'password' => Hash::make('rusakdeh'),
            'email_verified_at' => now(),
            'level_id' => 3,
            'unit_id' => 7,
        ]);
    }
}

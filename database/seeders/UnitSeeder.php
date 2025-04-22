<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create(['nama' => 'TK']);
        Unit::create(['nama' => 'SD']);
        Unit::create(['nama' => 'SMP']);
        Unit::create(['nama' => 'SMA']);
        Unit::create(['nama' => 'TU Pusat']);
        Unit::create(['nama' => 'Laboratorium']);
        Unit::create(['nama' => 'IT']);
    }
}

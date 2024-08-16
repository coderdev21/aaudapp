<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            ['name' => 'Bocas del Toro'],
            ['name' => 'Coclé'],
            ['name' => 'Colón'],
            ['name' => 'Chiriquí'],
            ['name' => 'Darien'],
            ['name' => 'Herrera'],
            ['name' => 'Los Santos'],
            ['name' => 'Panamá'],
            ['name' => 'Veraguas'],
            ['name' => 'Comarca Guna Yala'],
            ['name' => 'Comarca Emberá-Wounaan'],
            ['name' => 'Comarca Ngäbe-Buglé'],
            ['name' => 'Panamá Oeste'],
            ['name' => 'Comarca Naso Tjër Di'],
        ]);
    }
}

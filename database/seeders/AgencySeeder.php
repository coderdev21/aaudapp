<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agencies')->insert([
            ['name' => 'El Dorado'],
            ['name' => 'La Doña'],
            ['name' => 'Via Brasil'],
            ['name' => 'San Miguelito'],
            ['name' => 'Alcalde Díaz'],
            ['name' => 'Los Pueblos'],
            ['name' => 'P.H. Multiplaza'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('tasas')->insert([
      ['name' => 'Recolección Privada Diurna', 'tasa' => '1.75'],
      ['name' => 'Lotes Baldio', 'tasa' => '1.75'],
      ['name' => 'Barriada de Emergencia', 'tasa' => '1.75'],
      ['name' => 'Cuartos de Alquiler','tasa' => '2.50'],
      ['name' => 'Apartamento Nivel Bajo','tasa' => '5.00'],
      ['name' => 'Apartamento Nivel Medio','tasa' => '7.20'],
      ['name' => 'Apartamento Nivel Alto','tasa' => '10.30'],
      ['name' => 'Residencia Nivel Bajo','tasa' => '5.60'],
      ['name' => 'Residencia Nivel Medio','tasa' => '7.50'],
      ['name' => 'Residencial Nivel Alto','tasa' => '11.50'],
    ]);
  }
}

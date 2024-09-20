<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('conditions')->insert([
      ['name' => 'Buen Estado'],
      ['name' => 'Mal Estado'],
      ['name' => 'En taller'],
      ['name' => 'En Espera de Pieza'],
      ['name' => 'Para Descarte'],
      ['name' => 'Descartado'],
    ]);
  }
}

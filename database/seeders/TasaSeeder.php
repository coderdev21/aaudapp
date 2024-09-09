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
      ['tasa' => '1.75'],
      ['tasa' => '2.50'],
      ['tasa' => '5.60'],
      ['tasa' => '7.50'],
      ['tasa' => '10.00'],
      ['tasa' => '10.30'],
    ]);
  }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('brands')->insert([
      ['name' => 'APC'],
      ['name' => 'Apple'],
      ['name' => 'Asus'],
      ['name' => 'ATP'],
      ['name' => 'Benq'],
      ['name' => 'Brother'],
      ['name' => 'Canon'],
      ['name' => 'Cisco'],
      ['name' => 'Dell'],
      ['name' => 'D-LINK'],
      ['name' => 'Epson'],
      ['name' => 'Espo'],
      ['name' => 'ESTALKY'],
      ['name' => 'Evolis'],
      ['name' => 'FIRECAM'],
      ['name' => 'Forza'],
      ['name' => 'Gemini'],
      ['name' => 'Genius'],
      ['name' => 'Grandstream'],
      ['name' => 'GSP'],
      ['name' => 'Hailer'],
      ['name' => 'HAVIT'],
      ['name' => 'HIKVISION'],
      ['name' => 'HP'],
      ['name' => 'Jooyotech'],
      ['name' => 'JVC'],
      ['name' => 'KLIPXTREME'],
      ['name' => 'Kyocera'],
      ['name' => 'Lenovo'],
      ['name' => 'Lexmark'],
      ['name' => 'LG'],
      ['name' => 'Linksys'],
      ['name' => 'Logitech'],
      ['name' => 'MAXELL'],
      ['name' => 'Microline '],
      ['name' => 'Microsoft'],
      ['name' => 'Newlink'],
      ['name' => 'NEXXT'],
      ['name' => 'ONIKUMA'],
      ['name' => 'Panasonic'],
      ['name' => 'Planet N&C'],
      ['name' => 'POE'],
      ['name' => 'POLAR'],
      ['name' => 'Polaroid'],
      ['name' => 'POLY'],
      ['name' => 'Premier'],
      ['name' => 'Ricoh'],
      ['name' => 'Riso'],
      ['name' => 'Rlip'],
      ['name' => 'Samsung'],
      ['name' => 'Sankey'],
      ['name' => 'Selectron'],
      ['name' => 'SITEK'],
      ['name' => 'Sk-2085'],
      ['name' => 'Smarbitt'],
      ['name' => 'STALKY'],
      ['name' => 'TP-LINK'],
      ['name' => 'Tripp-Lite'],
      ['name' => 'T-VSION'],
      ['name' => 'ViewSonic'],
      ['name' => 'WD'],
      ['name' => 'Widmer'],
      ['name' => 'XTREME'],
      ['name' => 'Yealink'],
    ]);
  }
}

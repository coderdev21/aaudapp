<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrbanizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('urbanizations')->insert([
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'PACORA PARK'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'HACIENDA SAN ANTONIO'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'PACORA HOME'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'QUINTA DEL ESTE'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'QUINTA DEL ESTE, SEGUNDA ETAPA'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'VILLAS DE SAN JOSE'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'BOSQUES DE PACORA I'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'BOSQUES DE PACORA II'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'RESIDENCIAL ALBORAN'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'PACORA VILLAGE'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'PRADERAS DEL NORTE'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'CIUDAD DEL ESTE I'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'COMERCIO'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'RESIDENCIAL SIBONEY'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'COLINAS DEL ESTE'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'RESIDENCIAL PUEBLO NUEVO'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'QUINTA DEL ESTE, TERCERA ETAPA'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'VILLA BLANCA'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'HACIENDA DEL PACIFICO'],
        ['state_id' => '8', 'city_id' => '51', 'town_id' => '436', 'name' => 'CIUDAD DEL ESTE II'],
      ]);
    }
}

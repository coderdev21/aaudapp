<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([

            // Bocas del Toro

            ['state_id' => '1', 'name' => 'Almirante'],
            ['state_id' => '1', 'name' => 'Bocas del Toro'],
            ['state_id' => '1', 'name' => 'Changuinola'],
            ['state_id' => '1', 'name' => 'Chiriquí Grande'],

            // Coclé

            ['state_id' => '2', 'name' => 'Aguadulce'],
            ['state_id' => '2', 'name' => 'Antón'],
            ['state_id' => '2', 'name' => 'La Pintada'],
            ['state_id' => '2', 'name' => 'Natá'],
            ['state_id' => '2', 'name' => 'Olá'],
            ['state_id' => '2', 'name' => 'Penonomé'],

            // Colón

            ['state_id' => '3', 'name' => 'Chagres'],
            ['state_id' => '3', 'name' => 'Colón'],
            ['state_id' => '3', 'name' => 'Donoso'],
            ['state_id' => '3', 'name' => 'Omar Torrijos Herrera'],
            ['state_id' => '3', 'name' => 'Portobelo'],
            ['state_id' => '3', 'name' => 'Santa Isabel'],

            // Chiriquí

            ['state_id' => '4', 'name' => 'Alanje'],
            ['state_id' => '4', 'name' => 'Barú'],
            ['state_id' => '4', 'name' => 'Boquerón'],
            ['state_id' => '4', 'name' => 'Boquete'],
            ['state_id' => '4', 'name' => 'Bugaba'],
            ['state_id' => '4', 'name' => 'David'],
            ['state_id' => '4', 'name' => 'Dolega'],
            ['state_id' => '4', 'name' => 'Gualaca'],
            ['state_id' => '4', 'name' => 'Remedios'],
            ['state_id' => '4', 'name' => 'Renacimiento'],
            ['state_id' => '4', 'name' => 'San Félix'],
            ['state_id' => '4', 'name' => 'San Lorenzo'],
            ['state_id' => '4', 'name' => 'Tierras Altas'],
            ['state_id' => '4', 'name' => 'Tolé'],

            //Darien

            ['state_id' => '5', 'name' => 'Chepigana'],
            ['state_id' => '5', 'name' => 'Pinogana'],
            ['state_id' => '5', 'name' => 'Santa Fe'],

            // Herrera

            ['state_id' => '6', 'name' => 'Chitré'],
            ['state_id' => '6', 'name' => 'Las Minas'],
            ['state_id' => '6', 'name' => 'Los Pozos'],
            ['state_id' => '6', 'name' => 'Ocú'],
            ['state_id' => '6', 'name' => 'Parita'],
            ['state_id' => '6', 'name' => 'Pesé'],
            ['state_id' => '6', 'name' => 'Santa María'],

            // Los Santos

            ['state_id' => '7', 'name' => 'Guararé'],
            ['state_id' => '7', 'name' => 'Las Tablas'],
            ['state_id' => '7', 'name' => 'Los Santos'],
            ['state_id' => '7', 'name' => 'Macaracas'],
            ['state_id' => '7', 'name' => 'Pedasí'],
            ['state_id' => '7', 'name' => 'Pocrí'],
            ['state_id' => '7', 'name' => 'Tonosí'],

            // Panamá

            ['state_id' => '8', 'name' => 'Balboa'],
            ['state_id' => '8', 'name' => 'Chepo'],
            ['state_id' => '8', 'name' => 'Chimán'],
            ['state_id' => '8', 'name' => 'Panamá'],
            ['state_id' => '8', 'name' => 'San Miguelito'],
            ['state_id' => '8', 'name' => 'Taboga'],

            // Veraguas

            ['state_id' => '9', 'name' => 'Atalaya'],
            ['state_id' => '9', 'name' => 'Calobre'],
            ['state_id' => '9', 'name' => 'Cañazas'],
            ['state_id' => '9', 'name' => 'La Mesa'],
            ['state_id' => '9', 'name' => 'Las Palmas'],
            ['state_id' => '9', 'name' => 'Mariato'],
            ['state_id' => '9', 'name' => 'Montijo'],
            ['state_id' => '9', 'name' => 'Río de Jesús'],
            ['state_id' => '9', 'name' => 'San Francisco'],
            ['state_id' => '9', 'name' => 'Santa Fe'],
            ['state_id' => '9', 'name' => 'Santiago'],
            ['state_id' => '9', 'name' => 'Soná'],

            //Guna Yala

            ['state_id' => '10', 'name' => 'No tiene'],

            //Comarca Emberá-Wounaan

            ['state_id' => '11', 'name' => 'Cémaco'],
            ['state_id' => '11', 'name' => 'Sambú'],

            // Comarca Ngäbe-Buglé

            ['state_id' => '12', 'name' => 'Besikó'],
            ['state_id' => '12', 'name' => 'Jirondai'],
            ['state_id' => '12', 'name' => 'Kankintú'],
            ['state_id' => '12', 'name' => 'Kusapín'],
            ['state_id' => '12', 'name' => 'Mironó'],
            ['state_id' => '12', 'name' => 'Müna'],
            ['state_id' => '12', 'name' => 'Nole Duima'],
            ['state_id' => '12', 'name' => 'Ñürüm'],
            ['state_id' => '12', 'name' => 'Santa Catalina o Calovébora'],

            // Panamá Oeste

            ['state_id' => '13', 'name' => 'Arraiján'],
            ['state_id' => '13', 'name' => 'Capira'],
            ['state_id' => '13', 'name' => 'Chame'],
            ['state_id' => '13', 'name' => 'La Chorrera'],
            ['state_id' => '13', 'name' => 'San Carlos'],

            // Comarca Naso Tjër Di

            ['state_id' => '14', 'name' => 'Naso Tjër Di']
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('employees')->insert([
        [
          'employee_number' => '0',
          'nombre' => 'Admin',
          'segundo_nombre' => '',
          'apellido_paterno' => 'Admin',
          'apellido_materno' => '',
          'cedula' => '',
          'seguro_social' => '',
          'genero' => '1',
          'estado_civil' => '0',
          'state_id' => '8',
          'city_id' => '51',
          'town_id' => '436',
          'address' => '',
          'employee_type_id' => '1',
          'status' => 'A',
          'agency_id' => '7',
          'department_id' => '1',
          'numero_posicion' => '0',
          'image_url' => 'images/employees/SuperAdmin.jpg',
        ],
        [
          'employee_number' => '75039',
          'nombre' => 'Orlando',
          'segundo_nombre' => 'René',
          'apellido_paterno' => 'Sanjur',
          'apellido_materno' => 'Paz',
          'cedula' => '8-706-709',
          'seguro_social' => '999-9999',
          'genero' => '1',
          'estado_civil' => '0',
          'state_id' => '8',
          'city_id' => '51',
          'town_id' => '436',
          'address' => 'Villas de Bonanza, Casa A16',
          'employee_type_id' => '1',
          'status' => 'A',
          'agency_id' => '7',
          'department_id' => '1',
          'numero_posicion' => '60',
          'image_url' => 'images/employees/OrlandoSanjurPaz.png',
        ]
      ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'ADMINISTRACIÓN GENERAL'],
            ['name' => 'ARCHIVO'],
            ['name' => 'BIENES PATRIMONIALES'],
            ['name' => 'DEPARTAMENTO DE CATASTRO'],
            ['name' => 'DEPARTAMENTO DE COMECIALIZACIÓN'],
            ['name' => 'DEPARTAMENTO DE COMPRAS'],
            ['name' => 'DEPARTAMENTO DE CONTABILIDAD'],
            ['name' => 'DEPARTAMENTO DE FISCALIZACION'],
            ['name' => 'DEPARTAMENTO DE FOMENTO'],
            ['name' => 'DEPARTAMENTO DE PLANIFICACIÓN'],
            ['name' => 'DEPARTAMENTO DE PRESUPUESTO'],
            ['name' => 'DEPARTAMENTO DE PROVEEDURÍA Y COMPRAS'],
            ['name' => 'DEPARTAMENTO DE PROYECTOS ESPECIALES'],
            ['name' => 'DEPARTAMENTO DE SERVICIOS GENERALES'],
            ['name' => 'DEPARTAMENTO DE TESORERÍA'],
            ['name' => 'DIRECCION ADMINISTRATIVA'],
            ['name' => 'DIRECCIÓN DE FINANZAS'],
            ['name' => 'DEPARTAMENTO DE CAPACITACIONES AAUD'],
            ['name' => 'DIRECCIÓN DE OPERACIONES'],
            ['name' => 'DIRECCIÓN DE SERVICIOS TÉCNICOS'],
            ['name' => 'JUZGADO EJECUTOR'],
            ['name' => 'OFICINA DE ASESORÍA LEGAL'],
            ['name' => 'OFICINA DE AUDITORIA INTERNA'],
            ['name' => 'OFICINA DE RELACIONES PÚBLICAS'],
            ['name' => 'OFICINA INSTITUCIONAL DE RECURSOS HUMANOS'],
            ['name' => 'RECICLAAUD'],
            ['name' => 'SECRETARIA GENERAL'],
            ['name' => 'SERVICIOS GENERALES'],
            ['name' => 'SUBADMINISTRADOR GENERAL'],
            ['name' => 'UNIDAD DE BIENES PATRIMONIALES'],
            ['name' => 'UNIDAD DE INFORMATICA'],
            ['name' => 'VEOLIA'],
        ]);
    }
}

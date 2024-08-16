<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorrespondenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('correspondence_types')->insert([
            ['name' => 'ACTA'],
            ['name' => 'AUTO'],
            ['name' => 'CAJA MENUDA'],
            ['name' => 'CIRCULAR'],
            ['name' => 'CONTRATO'],
            ['name' => 'EMAIL'],
            ['name' => 'FORMULARIO'],
            ['name' => 'GESTION DE COBRO'],
            ['name' => 'HOJA DE TRAMITE'],
            ['name' => 'INFORME'],
            ['name' => 'ITOF'],
            ['name' => 'JUSTIFICACIÓN'],
            ['name' => 'MEMO'],
            ['name' => 'NOTA'],
            ['name' => 'OFICIO'],
            ['name' => 'ORDEN DE COMPRA'],
            ['name' => 'PROPUESTA'],
            ['name' => 'RESOLUCIÓN'],
        ]);
    }
}

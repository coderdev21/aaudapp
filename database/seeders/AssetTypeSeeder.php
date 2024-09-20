<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('asset_types')->insert([
        ['name' => 'Impresora'],
        ['name' => 'Computadore de Escritorio'],
        ['name' => 'Laptop'],
        ['name' => 'Celular'],
        ['name' => 'UPS'],
        ['name' => 'Switch'],
        ['name' => 'Router'],
        ['name' => 'Reloj de Marcación'],
        ['name' => 'Teclado'],
        ['name' => 'Mouse'],
        ['name' => 'HD Externo'],
        ['name' => 'Televisor'],
        ['name' => 'Proyector'],
        ['name' => 'Teléfono'],
        ['name' => 'Celular'],
        ['name' => 'Firewall'],
        ['name' => 'Servidor'],
        ['name' => 'Camara'],
        ['name' => 'Control de Acceso'],
        ['name' => 'Gabinete/Rack'],
        ['name' => 'Monitor'],
        ['name' => 'Radio Telecomunicaciones'],
        ['name' => 'Docking Station'],
      ]);
    }
}

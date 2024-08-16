<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banks')->insert([
            ['ruta_tran' => '000000000', 'name' => 'N/A', 'cta_corriente' => '0', 'cta_ahorro' => '0'],
            ['ruta_tran' => '000000013', 'name' => 'Banco Nacional de Panamá', 'cta_corriente' => '11', 'cta_ahorro' => '11'],
            ['ruta_tran' => '000000770', 'name' => 'Caja de Ahorros', 'cta_corriente' => '12', 'cta_ahorro' => '12'],
            ['ruta_tran' => '000001384', 'name' => 'BAC International Bank', 'cta_corriente' => '9', 'cta_ahorro' => '9'],
            ['ruta_tran' => '000000071', 'name' => 'Banco General, S.A.', 'cta_corriente' => '13', 'cta_ahorro' => '13'],
            ['ruta_tran' => '000000026', 'name' => 'HSBC BANK USA', 'cta_corriente' => '10', 'cta_ahorro' => '10'],
            ['ruta_tran' => '000000181', 'name' => 'BANCAFE (PANAMA), S.A.', 'cta_corriente' => '0', 'cta_ahorro' => '0'],
            ['ruta_tran' => '000001083', 'name' => 'Banco Aliado, S.A.', 'cta_corriente' => '12', 'cta_ahorro' => '12'],
            ['ruta_tran' => '000000848', 'name' => 'Banco Bilbao Vizcaya (Panama), S.A.', 'cta_corriente' => '17', 'cta_ahorro' => '17'],
            ['ruta_tran' => '000000518', 'name' => 'Banco Internacional de Costa Rica, S.A. (BICSA)', 'cta_corriente' => '6', 'cta_ahorro' => '0'],
            ['ruta_tran' => '000000767', 'name' => 'Banco Panameño de la Vivienda, S.A. (BANVIVIENDA)', 'cta_corriente' => '17', 'cta_ahorro' => '17'],
            ['ruta_tran' => '000001106', 'name' => 'Credicorp Bank, S.A.', 'cta_corriente' => '10', 'cta_ahorro' => '10'],
            ['ruta_tran' => '000001151', 'name' => 'Global Bank Corporation', 'cta_corriente' => '11', 'cta_ahorro' => '11'],
            ['ruta_tran' => '000001067', 'name' => 'Metrobank, S.A.', 'cta_corriente' => '12', 'cta_ahorro' => '12'],
            ['ruta_tran' => '000000408', 'name' => 'Towerbank International, Inc.', 'cta_corriente' => '11', 'cta_ahorro' => '11'],
            ['ruta_tran' => '000001465', 'name' => 'Banco Citibank (PANAMA), S. A.', 'cta_corriente' => '15', 'cta_ahorro' => '15'],
            ['ruta_tran' => '000001258', 'name' => 'Banco Universal', 'cta_corriente' => '16', 'cta_ahorro' => '16'],
            ['ruta_tran' => '000002503', 'name' => 'COOPEDUC', 'cta_corriente' => '17', 'cta_ahorro' => '17'],
            ['ruta_tran' => '000002516', 'name' => 'Coop. de Ahorro y Credito del Educador Santeño R.L.', 'cta_corriente' => '0', 'cta_ahorro' => '17'],
            ['ruta_tran' => '000002529', 'name' => 'Coop. de Ahorro y Credito del Educador Chiricano, R.L.', 'cta_corriente' => '0', 'cta_ahorro' => '17'],
            ['ruta_tran' => '000002545', 'name' => 'Coop. de Servicios Multiples El Educador Veraguense, R.L.', 'cta_corriente' => '0', 'cta_ahorro' => '17'],
            ['ruta_tran' => '000002532', 'name' => 'Coop. de Ahorro y Crédito de Educadores Coclesanos R.L.', 'cta_corriente' => '0', 'cta_ahorro' => '17'],
            ['ruta_tran' => '000001504', 'name' => 'Banco Azteca', 'cta_corriente' => '0', 'cta_ahorro' => '14'],
            ['ruta_tran' => '000001601', 'name' => 'Banco Panamá', 'cta_corriente' => '12', 'cta_ahorro' => '12'],
            ['ruta_tran' => '000001588', 'name' => 'BANESCO', 'cta_corriente' => '12', 'cta_ahorro' => '12'],
            ['ruta_tran' => '000001591', 'name' => 'Capital Bank', 'cta_corriente' => '0', 'cta_ahorro' => '0'],
            ['ruta_tran' => '000001478', 'name' => 'MMG Bank', 'cta_corriente' => '14', 'cta_ahorro' => '14'],
            ['ruta_tran' => '000001494', 'name' => 'ST. Georges Bank', 'cta_corriente' => '14', 'cta_ahorro' => '14'],
            ['ruta_tran' => '000001397', 'name' => 'BCT Bank International', 'cta_corriente' => '5', 'cta_ahorro' => '5'],
            ['ruta_tran' => '000001533', 'name' => 'PRODUBANK', 'cta_corriente' => '11', 'cta_ahorro' => '11'],
            ['ruta_tran' => '000001562', 'name' => 'Banco DELTA', 'cta_corriente' => '17', 'cta_ahorro' => '17'],
            ['ruta_tran' => '000001575', 'name' => 'Banco LAFISE', 'cta_corriente' => '9', 'cta_ahorro' => '9'],
            ['ruta_tran' => '000001672', 'name' => 'Banco PRIVAL', 'cta_corriente' => '12', 'cta_ahorro' => '12'],
            ['ruta_tran' => '000001685', 'name' => 'BALBOA BANK & TRUST CORP.', 'cta_corriente' => '12', 'cta_ahorro' => '12'],
            ['ruta_tran' => '000001708', 'name' => 'UNI BANK & TRUST, INC.', 'cta_corriente' => '10', 'cta_ahorro' => '10'],
            ['ruta_tran' => '000000372', 'name' => 'Multibank', 'cta_corriente' => '0', 'cta_ahorro' => '0'],
            ['ruta_tran' => '000000039', 'name' => 'Citibank, N.A.', 'cta_corriente' => '15', 'cta_ahorro' => '15'],
            ['ruta_tran' => '000000424', 'name' => 'SCOTIABANK', 'cta_corriente' => '12', 'cta_ahorro' => '12'],
        ]);
    }
}

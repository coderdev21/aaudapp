<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['name' => 'Admin', 'email' => 'coder.dev507@gmail.com', 'password' => Hash::make('12345678')],
            ['name' => 'osanjur', 'email' => 'osanjur@aaud.gob.pa', 'password' => Hash::make('12345678')],
            //['name' => 'lchanis', 'employee_id' => '2', 'email' => 'lchanis@aaud.gob.pa', 'password' => Hash::make('12345678')],
            //['name' => 'rvargas', 'employee_id' => '2', 'email' => 'rvargas@aaud.gob.pa', 'password' => Hash::make('12345678')],
            //['name' => 'dtunon', 'employee_id' => '2', 'email' => 'dtunon@aaud.gob.pa', 'password' => Hash::make('12345678')],
            //['name' => 'ffanilla', 'employee_id' => '2', 'email' => 'ffanilla@aaud.gob.pa', 'password' => Hash::make('12345678')],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // create permissions
    Permission::create(['name' => 'Usuarios - Crear']);
    Permission::create(['name' => 'Usuarios - Ver']);
    Permission::create(['name' => 'Usuarios - Editar']);
    Permission::create(['name' => 'Usuarios - Eliminar']);

    Permission::create(['name' => 'Paz y Salvo - Crear']);
    Permission::create(['name' => 'Paz y Salvo - Ver']);
    Permission::create(['name' => 'Paz y Salvo - Editar']); 
    Permission::create(['name' => 'Paz y Salvo - Eliminar']);

    // create roles and assign created permissions

    // this can be done as separate statements
    /*     $role = Role::create(['name' => 'Administrador']);
    $role->givePermissionTo('edit articles'); */

    // or may be done by chaining
    /*     $role = Role::create(['name' => 'moderator'])
      ->givePermissionTo(['publish articles', 'unpublish articles']); */

    // Creo el rol Super Admin
    Role::create(['name' => 'Super Admin'])
      ->givePermissionTo(Permission::all()); //Le asigno todos los permisos al rol Super Amdin

    // Asigno el rol Super Admin al usuario Admin
    $superadmin = User::find(1);
    $superadmin->assignRole('Super Admin');

    // Creo el rol Administrador
    Role::create(['name' => 'Administrador'])
      ->givePermissionTo(['Usuarios - Crear', 'Usuarios - Editar', 'Usuarios - Eliminar']); //Le asigno los permisos de Configuración

    // Asigno el rol Administrador al usuario osanjur@aaud.gob.pa
    $admin = User::where('id', '2')->first();
    $admin->assignRole('Administrador');
  }
}

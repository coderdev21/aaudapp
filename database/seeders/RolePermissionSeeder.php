<?php

namespace Database\Seeders;

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
    Permission::create(['name' => 'Crear Paz y Salvo']);
    Permission::create(['name' => 'Ver Paz y Salvo']);

    // create roles and assign created permissions

    // this can be done as separate statements
/*     $role = Role::create(['name' => 'Administrador']);
    $role->givePermissionTo('edit articles'); */

    // or may be done by chaining
/*     $role = Role::create(['name' => 'moderator'])
      ->givePermissionTo(['publish articles', 'unpublish articles']); */

    $role = Role::create(['name' => 'Administrador']);
    $role->givePermissionTo(Permission::all());
  }
}

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
    Permission::create(['name' => 'view_any_role']);
    Permission::create(['name' => 'view_role']);
    Permission::create(['name' => 'create_role']); 
    Permission::create(['name' => 'update_role']);
    Permission::create(['name' => 'delete_role']);
    Permission::create(['name' => 'delete_any_role']);
    Permission::create(['name' => 'view_any_user']);
    Permission::create(['name' => 'view_user']);
    Permission::create(['name' => 'create_user']);
    Permission::create(['name' => 'update_user']);
    Permission::create(['name' => 'delete_user']);
    Permission::create(['name' => 'delete_any_user']);
    Permission::create(['name' => 'force_delete_user']);
    Permission::create(['name' => 'force_delete_any_user']);
    Permission::create(['name' => 'restore_user']);
    Permission::create(['name' => 'restore_any_user']);
    Permission::create(['name' => 'replicate_user']);
    Permission::create(['name' => 'reorder_user']);



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
      ->givePermissionTo([
        'view_any_role', 
        'view_role', 
        'create_role', 
        'update_role', 
        'delete_role', 
        'delete_any_role',
        'view_any_user',
        'view_user',
        'create_user',
        'update_user',
        'delete_user',
        'delete_any_user',
        'force_delete_user',
        'force_delete_any_user',
        'restore_user',
        'restore_any_user',
        'replicate_user',
        'reorder_user',
      ]); //Le asigno los permisos de Configuración

    // Asigno el rol Administrador al usuario osanjur@aaud.gob.pa
    $admin = User::where('id', '2')->first();
    $admin->assignRole('Administrador');
  }
}

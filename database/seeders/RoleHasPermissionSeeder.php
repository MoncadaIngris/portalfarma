<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $facultativo_permissions = Permission::whereBetween('id', [1, 4]);
        $abastecimiento_permissions = Permission::whereBetween('id', [2, 11]);
        $vendedor_permissions = Permission::whereBetween('id', [10, 18]);
        $admin_permissions = Permission::whereBetween('id', [1, 37]);
        $desarrollador_permissions = Permission::all();

            // admin
            Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
            //desarrollador
            Role::findOrFail(2)->permissions()->sync($desarrollador_permissions->pluck('id'));
            // Facultativo
            Role::findOrFail(3)->permissions()->sync($facultativo_permissions->pluck('id'));
            // Abastecimiento
            Role::findOrFail(4)->permissions()->sync($abastecimiento_permissions->pluck('id'));
            // Vendedor
            Role::findOrFail(5)->permissions()->sync($vendedor_permissions->pluck('id'));
    }
}

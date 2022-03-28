<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
           
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // spatie documentation
         app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        //Inicio Permissions de facultativo
        Permission::create([
            'titulo' => 'Nuevo producto',
            'name' => 'productos_nuevo',
        ]);
        Permission::create([
            'titulo' => 'Editar productos',
            'name' => 'productos_editar',
        ]);
        Permission::create([
            'titulo' => 'Detalle productos',
            'name' => 'productos_detalle',
        ]);
        Permission::create([
            'titulo' => 'Lista productos',
            'name' => 'productos_index',
        ]);
        //Finaliza persmisos de facultativo del 1 al 4

        //inicia Permissions de abastecimiento
        Permission::create([
            'titulo' => 'Lista proveedores',
            'name' => 'proveedores_index',
        ]);
        Permission::create([
            'titulo' => 'Detalle proveedores',
            'name' => 'proveedores_detalle',
        ]);
        Permission::create([
            'titulo' => 'Lista compras',
            'name' => 'compras_index',
        ]);
        Permission::create([
            'titulo' => 'Nuevo compra',
            'name' => 'compras_nuevo',
        ]);
        Permission::create([
            'titulo' => 'Detalle compras',
            'name' => 'compras_detalle',
        ]);
        Permission::create([
            'titulo' => 'Lista inventarios',
            'name' => 'inventarios_index',
        ]);
        Permission::create([
            'titulo' => 'Detalle inventarios',
            'name' => 'inventarios_detalle',
        ]);
        //finalizar Permissions de abastecimiento del 2 al 11

        //inicio de Permissions de vendedor
        Permission::create([
            'titulo' => 'Lista clientes',
            'name' => 'clientes_index',
        ]);
        Permission::create([
            'titulo' => 'Nuevo cliente',
            'name' => 'clientes_nuevo',
        ]);
        Permission::create([
            'titulo' => 'Editar clientes',
            'name' => 'clientes_editar',
        ]);
        Permission::create([
            'titulo' => 'Detalle clientes',
            'name' => 'clientes_detalle',
        ]);
        Permission::create([
            'titulo' => 'Lista ventas',
            'name' => 'ventas_index',
        ]);
        Permission::create([
            'titulo' => 'Nuevo venta',
            'name' => 'ventas_nuevo',
        ]);
        Permission::create([
            'titulo' => 'Detalle ventas',
            'name' => 'ventas_detalle',
        ]);
        //finaliza Permissions de vendedor del 10 al 18

        Permission::create([
            'titulo' => 'Lista empleados',
            'name' => 'empleados_index',
        ]);
        Permission::create([
            'titulo' => 'Nuevo empleado',
            'name' => 'empleados_nuevo',
        ]);
        Permission::create([
            'titulo' => 'Editar empleados',
            'name' => 'empleados_editar',
        ]);
        Permission::create([
            'titulo' => 'Detalle empleados',
            'name' => 'empleados_detalle',
        ]);
        Permission::create([
            'titulo' => 'Desactivar empleados',
            'name' => 'empleados_desactivar',
        ]);
        Permission::create([
            'titulo' => 'Lista empleados desactivados',
            'name' => 'empleados_desactivados',
        ]);
        Permission::create([
            'titulo' => 'Activar empleados',
            'name' => 'empleados_activar',
        ]);
        
        Permission::create([
            'titulo' => 'Nuevo proveedor',
            'name' => 'proveedores_nuevo',
        ]);
        Permission::create([
            'titulo' => 'Editar proveedores',
            'name' => 'proveedores_editar',
        ]);
        
        Permission::create([
            'titulo' => 'Desactivar proveedores',
            'name' => 'proveedores_desactivar',
        ]);
        Permission::create([
            'titulo' => 'Lista proveedores desactivados',
            'name' => 'proveedores_desactivados',
        ]);
        Permission::create([
            'titulo' => 'Activar proveedores',
            'name' => 'proveedores_activar',
        ]);
        Permission::create([
            'titulo' => 'Entrada y salida',
            'name' => 'entrada_salida',
        ]);
        Permission::create([
            'titulo' => 'Grafico cliente',
            'name' => 'grafico_cliente',
        ]);
        Permission::create([
            'titulo' => 'Grafico producto',
            'name' => 'grafico_producto',
        ]);
        Permission::create([
            'titulo' => 'Grafico proveedor',
            'name' => 'grafico_proveedor',
        ]);
        Permission::create([
            'titulo' => 'Grafico fecha',
            'name' => 'grafico_fecha',
        ]);
        Permission::create([
            'titulo' => 'Lista de permisos',
            'name' => 'permisos_index',
        ]);
        Permission::create([
            'titulo' => 'Nuevo permiso',
            'name' => 'permisos_nuevo',
        ]);
        Permission::create([
            'titulo' => 'Editar permisos',
            'name' => 'permisos_editar',
        ]);
        Permission::create([
            'titulo' => 'Lista de roles',
            'name' => 'roles_index',
        ]);
        Permission::create([
            'titulo' => 'Nuevo role',
            'name' => 'roles_nuevo',
        ]);
        Permission::create([
            'titulo' => 'Editar roles',
            'name' => 'roles_editar',
        ]);
        Permission::create([
            'titulo' => 'Lista de usuarios',
            'name' => 'usuarios_index',
        ]);
        Permission::create([
            'titulo' => 'Nuevo usuario',
            'name' => 'usuarios_nuevo',
        ]);
        
    }
}

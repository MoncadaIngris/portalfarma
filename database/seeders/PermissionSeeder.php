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
            'id_partes' => 1,
        ]);
        Permission::create([
            'titulo' => 'Editar productos',
            'name' => 'productos_editar',
            'id_partes' => 2,
        ]);
        Permission::create([
            'titulo' => 'Detalle productos',
            'name' => 'productos_detalle',
            'id_partes' => 3,
        ]);
        Permission::create([
            'titulo' => 'Lista productos',
            'name' => 'productos_index',
            'id_partes' => 4,
        ]);
        //Finaliza persmisos de facultativo del 1 al 4

        //inicia Permissions de abastecimiento
        Permission::create([
            'titulo' => 'Lista proveedores',
            'name' => 'proveedores_index',
            'id_partes' => 8,
        ]);
        Permission::create([
            'titulo' => 'Detalle proveedores',
            'name' => 'proveedores_detalle',
            'id_partes' => 7,
        ]);
        Permission::create([
            'titulo' => 'Lista compras',
            'name' => 'compras_index',
            'id_partes' => 14,
        ]);
        Permission::create([
            'titulo' => 'Nuevo compra',
            'name' => 'compras_nuevo',
            'id_partes' => 12,
        ]);
        Permission::create([
            'titulo' => 'Detalle compras',
            'name' => 'compras_detalle',
            'id_partes' => 13,
        ]);
        Permission::create([
            'titulo' => 'Lista inventarios',
            'name' => 'inventarios_index',
            'id_partes' => 16,
        ]);
        Permission::create([
            'titulo' => 'Detalle inventarios',
            'name' => 'inventarios_detalle',
            'id_partes' => 15,
        ]);
        //finalizar Permissions de abastecimiento del 2 al 11

        //inicio de Permissions de vendedor
        Permission::create([
            'titulo' => 'Lista clientes',
            'name' => 'clientes_index',
            'id_partes' => 20,
        ]);
        Permission::create([
            'titulo' => 'Nuevo cliente',
            'name' => 'clientes_nuevo',
            'id_partes' => 17,
        ]);
        Permission::create([
            'titulo' => 'Editar clientes',
            'name' => 'clientes_editar',
            'id_partes' => 18,
        ]);
        Permission::create([
            'titulo' => 'Detalle clientes',
            'name' => 'clientes_detalle',
            'id_partes' => 19,
        ]);
        Permission::create([
            'titulo' => 'Lista ventas',
            'name' => 'ventas_index',
            'id_partes' => 23,
        ]);
        Permission::create([
            'titulo' => 'Nuevo venta',
            'name' => 'ventas_nuevo',
            'id_partes' => 21,
        ]);
        Permission::create([
            'titulo' => 'Detalle ventas',
            'name' => 'ventas_detalle',
            'id_partes' => 22,
        ]);
        //finaliza Permissions de vendedor del 10 al 18

        Permission::create([
            'titulo' => 'Lista empleados',
            'name' => 'empleados_index',
            'id_partes' => 27,
        ]);
        Permission::create([
            'titulo' => 'Nuevo empleado',
            'name' => 'empleados_nuevo',
            'id_partes' => 24,
        ]);
        Permission::create([
            'titulo' => 'Editar empleados',
            'name' => 'empleados_editar',
            'id_partes' => 25,
        ]);
        Permission::create([
            'titulo' => 'Detalle empleados',
            'name' => 'empleados_detalle',
            'id_partes' => 26,
        ]);
        Permission::create([
            'titulo' => 'Desactivar empleados',
            'name' => 'empleados_desactivar',
            'id_partes' => 28,
        ]);
        Permission::create([
            'titulo' => 'Lista empleados desactivados',
            'name' => 'empleados_desactivados',
            'id_partes' => 29,
        ]);
        Permission::create([
            'titulo' => 'Activar empleados',
            'name' => 'empleados_activar',
            'id_partes' => 30,
        ]);
        
        Permission::create([
            'titulo' => 'Nuevo proveedor',
            'name' => 'proveedores_nuevo',
            'id_partes' => 5,
        ]);
        Permission::create([
            'titulo' => 'Editar proveedores',
            'name' => 'proveedores_editar',
            'id_partes' => 6,
        ]);
        
        Permission::create([
            'titulo' => 'Desactivar proveedores',
            'name' => 'proveedores_desactivar',
            'id_partes' => 9,
        ]);
        Permission::create([
            'titulo' => 'Lista proveedores desactivados',
            'name' => 'proveedores_desactivados',
            'id_partes' => 10,
        ]);
        Permission::create([
            'titulo' => 'Activar proveedores',
            'name' => 'proveedores_activar',
            'id_partes' => 11,
        ]);
        Permission::create([
            'titulo' => 'Entrada y salida',
            'name' => 'entrada_salida',
            'id_partes' => 35,
        ]);
        Permission::create([
            'titulo' => 'Grafico cliente',
            'name' => 'grafico_cliente',
            'id_partes' => 31,
        ]);
        Permission::create([
            'titulo' => 'Grafico producto',
            'name' => 'grafico_producto',
            'id_partes' => 32,
        ]);
        Permission::create([
            'titulo' => 'Grafico proveedor',
            'name' => 'grafico_proveedor',
            'id_partes' => 33,
        ]);
        Permission::create([
            'titulo' => 'Grafico fecha',
            'name' => 'grafico_fecha',
            'id_partes' => 34,
        ]);
        Permission::create([
            'titulo' => 'Lista de usuarios',
            'name' => 'usuarios_index',
            'id_partes' => 43,
        ]);
        Permission::create([
            'titulo' => 'Nuevo usuario',
            'name' => 'usuarios_nuevo',
            'id_partes' => 42,
        ]);

        Permission::create([
            'titulo' => 'Lista de jornadas',
            'name' => 'jornada_index',
            'id_partes' => 44,
        ]);
        Permission::create([
            'titulo' => 'Nueva jornada',
            'name' => 'jornada_nuevo',
            'id_partes' => 45,
        ]);
        Permission::create([
            'titulo' => 'Editar jornada',
            'name' => 'jornada_editar',
            'id_partes' => 46,
        ]);
        
        Permission::create([
            'titulo' => 'Lista de permisos',
            'name' => 'permisos_index',
            'id_partes' => 38,
        ]);
        Permission::create([
            'titulo' => 'Nuevo permiso',
            'name' => 'permisos_nuevo',
            'id_partes' => 36,
        ]);
        Permission::create([
            'titulo' => 'Editar permisos',
            'name' => 'permisos_editar',
            'id_partes' => 37,
        ]);
        Permission::create([
            'titulo' => 'Lista de roles',
            'name' => 'roles_index',
            'id_partes' => 41,
        ]);
        Permission::create([
            'titulo' => 'Nuevo role',
            'name' => 'roles_nuevo',
            'id_partes' => 39,
        ]);
        Permission::create([
            'titulo' => 'Editar roles',
            'name' => 'roles_editar',
            'id_partes' => 40,
        ]);
        
    }
}


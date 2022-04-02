<?php

namespace Database\Seeders;
use App\Models\Parte;
use Illuminate\Database\Seeder;

class ParteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //producto
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 1,
        ]);
        Parte::create([
            'descripcion' => 'editar',
            'id_modelo' => 1,
        ]);
        Parte::create([
            'descripcion' => 'detalle',
            'id_modelo' => 1,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 1,
        ]);

        //proveedores
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 2,
        ]);
        Parte::create([
            'descripcion' => 'editar',
            'id_modelo' => 2,
        ]);
        Parte::create([
            'descripcion' => 'detalle',
            'id_modelo' => 2,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 2,
        ]);
        Parte::create([
            'descripcion' => 'desactivar',
            'id_modelo' => 2,
        ]);
        Parte::create([
            'descripcion' => 'desactivados',
            'id_modelo' => 2,
        ]);
        Parte::create([
            'descripcion' => 'activar',
            'id_modelo' => 2,
        ]);

        //compras
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 3,
        ]);
        Parte::create([
            'descripcion' => 'detalle',
            'id_modelo' => 3,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 3,
        ]);

        //inventarios
        Parte::create([
            'descripcion' => 'detalle',
            'id_modelo' => 4,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 4,
        ]);

        //clientes
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 5,
        ]);
        Parte::create([
            'descripcion' => 'editar',
            'id_modelo' => 5,
        ]);
        Parte::create([
            'descripcion' => 'detalle',
            'id_modelo' => 5,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 5,
        ]);

        //ventas
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 6,
        ]);
        Parte::create([
            'descripcion' => 'detalle',
            'id_modelo' => 6,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 6,
        ]);

        //empleados
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 7,
        ]);
        Parte::create([
            'descripcion' => 'editar',
            'id_modelo' => 7,
        ]);
        Parte::create([
            'descripcion' => 'detalle',
            'id_modelo' => 7,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 7,
        ]);
        Parte::create([
            'descripcion' => 'desactivar',
            'id_modelo' => 7,
        ]);
        Parte::create([
            'descripcion' => 'desactivados',
            'id_modelo' => 7,
        ]);
        Parte::create([
            'descripcion' => 'activar',
            'id_modelo' => 7,
        ]);

        //grafico
        Parte::create([
            'descripcion' => 'cliente',
            'id_modelo' => 9,
        ]);
        Parte::create([
            'descripcion' => 'producto',
            'id_modelo' => 8,
        ]);
        Parte::create([
            'descripcion' => 'proveedor',
            'id_modelo' => 8,
        ]);
        Parte::create([
            'descripcion' => 'fecha',
            'id_modelo' => 8,
        ]);

        //entrada
        Parte::create([
            'descripcion' => 'salida',
            'id_modelo' => 9,
        ]);

        //permiso
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 10,
        ]);
        Parte::create([
            'descripcion' => 'editar',
            'id_modelo' => 10,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 10,
        ]);

        //roles
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 11,
        ]);
        Parte::create([
            'descripcion' => 'editar',
            'id_modelo' => 11,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 11,
        ]);

        //usuarios
        Parte::create([
            'descripcion' => 'nuevo',
            'id_modelo' => 12,
        ]);
        Parte::create([
            'descripcion' => 'index',
            'id_modelo' => 12,
        ]);


    }
}

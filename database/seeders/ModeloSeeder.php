<?php

namespace Database\Seeders;
use App\Models\Modelo;
use Illuminate\Database\Seeder;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['descripcion' => 'productos'],
            ['descripcion' => 'proveedores'],
            ['descripcion' => 'compras'],
            ['descripcion' => 'inventarios'],

            ['descripcion' => 'clientes'],
            ['descripcion' => 'ventas'],
            ['descripcion' => 'empleados'],
            ['descripcion' => 'grafico'],

            ['descripcion' => 'entrada'],
            ['descripcion' => 'permisos'],
            ['descripcion' => 'roles'],
            ['descripcion' => 'usuarios'],
        ];
        foreach($datos as $conce){
            Modelo::create($conce);
        }
    }
}

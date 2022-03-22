<?php

namespace Database\Seeders;
use App\Models\Empleado;

use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empleado::create(
            [
                'nombres' => 'Portal',
                'apellidos' => 'Farma',
                'correo_electronico' => 'portalfarma@gmail.com',
                'telefono_personal' => '00000000',
                'telefono_personal' => '00000000',
                'fecha_de_nacimiento' => '00000000',
                'fecha_de_ingreso' => '00000000',
                'direccion' => 'El Paraíso, El Paraíso barrio San Isidro, 1/2 abajo del Instituto Armando Martinez',
                'DNI' => '0000000000000',
                'fotografia' => 'images/1.jpg',
            ]
        );
        
        Empleado::Factory(30)->create();
     
    }
}

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
                'telefono_alternativo' => '00000000',
                'fecha_de_nacimiento' => '00000000',
                'fecha_de_ingreso' => '00000000',
                'direccion' => 'El Paraíso, El Paraíso barrio San Isidro, 1/2 abajo del Instituto Armando Martinez',
                'DNI' => '0000000000000',
                'cargo' => 1,
                'fotografia' => 'images/1.jpg',
            ]
        );

        Empleado::create(
            [
                'nombres' => 'Ingris Neptalia',
                'apellidos' => 'Carcamo Moncada',
                'correo_electronico' => 'Ingrismoncada28@gmail.com',
                'telefono_personal' => '88740617',
                'telefono_alternativo' => '95372317',
                'fecha_de_nacimiento' => '1996-08-28',
                'fecha_de_ingreso' => '2022-01-24',
                'direccion' => 'Danli',
                'DNI' => '0703199700163',
                'cargo' => 1,
                'fotografia' => 'images/2.jpg',
            ]
        );

        Empleado::create(
            [
                'nombres' => 'Ruth Abigail',
                'apellidos' => 'Fonseca Reconco',
                'correo_electronico' => 'fonsecaruth98@gmail.com',
                'telefono_personal' => '89680132',
                'telefono_alternativo' => '88007828',
                'fecha_de_nacimiento' => '1998-02-07',
                'fecha_de_ingreso' => '2022-01-24',
                'direccion' => 'Danli',
                'DNI' => '0710199800012',
                'cargo' => 1,
                'fotografia' => 'images/3.jpg',
            ]
        );

        Empleado::create(
            [
                'nombres' => 'Juan',
                'apellidos' => 'Vallecillo',
                'correo_electronico' => 'juanillooe@gmail.com',
                'telefono_personal' => '96496009',
                'telefono_alternativo' => '24011996',
                'fecha_de_nacimiento' => '1998-02-07',
                'fecha_de_ingreso' => '2022-01-24',
                'direccion' => 'El Paraíso, El Paraíso ',
                'DNI' => '0703199604602',
                'cargo' => 1,
                'fotografia' => 'images/4.jpg',
            ]
        );

        Empleado::create(
            [
                'nombres' => 'Estefany',
                'apellidos' => 'Yissel López',
                'correo_electronico' => 'estefanyyissel@gmail.com',
                'telefono_personal' => '98941606',
                'telefono_alternativo' => '34011996',
                'fecha_de_nacimiento' => '1996-10-18',
                'fecha_de_ingreso' => '2022-01-24',
                'direccion' => 'Danli ',
                'DNI' => '0703199604348',
                'cargo' => 1,
                'fotografia' => 'images/5.jpg',
            ]
        );

        Empleado::create(
            [
                'nombres' => 'Jorge',
                'apellidos' => 'Enrique gonzalez',
                'correo_electronico' => 'jorgeenriquegonzalez6@gmail.com',
                'telefono_personal' => '89579860',
                'telefono_alternativo' => '99639820',
                'fecha_de_nacimiento' => '1997-06-15',
                'fecha_de_ingreso' => '2022-01-24',
                'direccion' => 'El Paraiso ',
                'DNI' => '0704199700820',
                'cargo' => 1,
                'fotografia' => 'images/6.jpg',
            ]
        );
        
        Empleado::Factory(25)->create();
     
    }
}

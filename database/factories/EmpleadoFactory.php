<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this -> faker -> name(),
            'apellidos'=> $this -> faker -> lastname(),
            'correo_electronico'=> $this -> faker -> email(),
            'telefono_personal' => $this-> faker -> numerify('########'),
            'telefono_alternativo'=> $this -> faker -> numerify('########') ,
            'fecha_de_nacimiento'=> $this -> faker ->date($format='Y-m-d', $max= 'now'),
             'direccion'=> $this -> faker -> text(50),
             'DNI' => $this-> faker ->  numerify('#############'),
             'fotografia' => $this->faker -> imageUrl($width = 640, $height = 480),

        ];
    }
}

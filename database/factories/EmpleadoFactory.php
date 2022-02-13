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
            'correo_electronico'=> $this -> faker ->unique()-> email(),
            'telefono_personal'  => $this-> faker -> randomElement([2,3,8,9]).$this-> faker ->unique() -> numerify('########'),
            'telefono_alternativo' => $this-> faker -> randomElement([2,3,8,9]).$this-> faker ->unique() -> numerify('########'),
            'fecha_de_nacimiento'=> $this -> faker ->date($format='Y-m-d', $max= 'now'),
             'direccion'=> $this -> faker -> text(50),
             'DNI'  => $this-> faker -> numberBetween($min = 1, $max = 18).$this-> faker -> numberBetween($min = 1, $max = 28).$this-> faker -> numberBetween($min =1957, $max = 2004).$this-> faker ->unique()-> numerify('#####'),
             'fotografia' => $this->faker -> imageUrl($width = 640, $height = 480),
             'estado' => $this->faker ->randomElement([0,1]),
        ];
    }
}

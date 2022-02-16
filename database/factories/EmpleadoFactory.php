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
        $fecha_actual = date("d-m-Y");
        $max = date('d-m-Y',strtotime($fecha_actual."- 18 year"));
        $minima = date('d-m-Y',strtotime($fecha_actual."- 65 year"));
        $maxima = date("d-m-Y",strtotime($max."+ 1 days"));

        return [
            'nombres' => $this -> faker -> name(),
            'apellidos'=> $this -> faker -> lastname(),
            'correo_electronico'=> $this -> faker ->unique()-> email(),
            'telefono_personal'  => $this-> faker -> randomElement([2,3,8,9]).$this-> faker ->unique() -> numerify('#######'),
            'telefono_alternativo' => $this-> faker -> randomElement([2,3,8,9]).$this-> faker ->unique() -> numerify('#######'),
            'fecha_de_nacimiento'=> $this -> faker ->date($format='Y-m-d', $max= $maxima, $min= $minima),
             'direccion'=> $this -> faker -> text(50),
             'DNI'  =>substr(str_repeat(0, 2).$this-> faker -> numberBetween($min = 1, $max = 18), - 2).substr(str_repeat(0, 2).$this-> faker -> numberBetween($min = 1, $max = 28), - 2).$this-> faker -> numberBetween($min =1957, $max = 2004).$this-> faker ->unique()-> numerify('#####'),
             'fotografia' => 'images/'.$this->faker -> numberBetween($min = 1, $max = 18).'.jpg',
             'estado' => $this->faker ->randomElement([0,1]),
        ];
    }
}

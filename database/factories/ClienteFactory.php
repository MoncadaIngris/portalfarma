<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this -> faker -> firstname(),
            'apellidos'=> $this -> faker -> lastname(),
            'telefono'  => $this-> faker -> randomElement([2,3,8,9]).$this-> faker ->unique() -> numerify('#######'),
             'direccion'=> $this -> faker -> text(50),
             'DNI'  =>substr(str_repeat(0, 2).$this-> faker -> numberBetween($min = 1, $max = 18), - 2).substr(str_repeat(0, 2).$this-> faker -> numberBetween($min = 1, $max = 28), - 2).$this-> faker -> numberBetween($min =1957, $max = 2004).$this-> faker ->unique()-> numerify('#####'),
        ];
    }
}

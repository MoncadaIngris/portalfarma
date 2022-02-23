<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
     
        return [
            'nombre' => $this -> faker ->jobTitle(),
            'codigo' => $this -> faker ->ean8(),
            'concentracion' => $this -> faker ->sentence('20'),
            'receta' => $this -> faker -> text($maxNbChars = 100),
            'precio' => $this -> faker -> numberBetween(2,5000),
            'cantidad' => $this -> faker ->numberBetween(1,10000),
            'estado' => $this->faker ->randomElement([0,1]),
        ];
    }
}

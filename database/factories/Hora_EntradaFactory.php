<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Hora_EntradaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hora' => $this -> faker ->randomElement(['07:00:00','08:00:00','09:00:00']),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Hora_SalidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hora' => $this -> faker ->randomElement(['15:00:00','16:00:00','17:00:00','18:00:00']),
        ];
    }
}

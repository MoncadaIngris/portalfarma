<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this -> faker -> randomElement($array = array ('Permiso de salida','Permiso de Entrada','Permiso Especial', 'Permiso Semanal',
                'Permiso Vacacional', 'Permiso de Salud', 'Permiso Mixto' )),
            'descripcion' => $this -> faker -> sentence($nbWords = 6, $variableNbWords = true)
        ];
    }
}

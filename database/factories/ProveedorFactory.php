<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_repartidor'=> $this -> faker -> name(),
            'correo_electronico'=> $this -> faker ->unique()-> email(),
            'telefono_repartidor' => $this-> faker -> randomElement([2,3,8,9]).$this-> faker ->unique() -> numerify('########'),
            'nombre_proveedor'=> $this -> faker -> name(),
            'telefono_proveedor'=> $this-> faker -> randomElement([2,3,8,9]).$this-> faker ->unique() -> numerify('########'),
            'dia_de_entrega'=> $this->faker ->randomElement(['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo']),
        ];
    }
}

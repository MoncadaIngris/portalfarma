<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
                'codigo_producto' => $this -> faker ->jobTitle(),   
                'nombre_producto' => $this -> faker ->ean8(),  
                'precio_compra' => $this -> faker -> randomElement([0,1]),   
                             
          
        ];
    }
}

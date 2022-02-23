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
            'concentracion' => $this -> faker ->randomElement(['Sin concentración', '250mg', '500mg','1000mg']),     
            'receta' => $this -> faker -> randomElement([0,1]),   
            'descripcion'=> $this -> faker -> text(50),             
      ];
     
    }
}

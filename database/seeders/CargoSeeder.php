<?php

namespace Database\Seeders;
use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['descripcion' => 'Gerente'],
            ['descripcion' => 'Vendedor'],
            ['descripcion' => 'Abastecimiento'],
            ['descripcion' => 'Auxiliar'],
            ['descripcion' => 'Facultativo'],
        ];
        foreach($datos as $conce){
            Cargo::create($conce);
        }
    }
}

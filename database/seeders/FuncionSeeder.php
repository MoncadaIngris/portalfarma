<?php

namespace Database\Seeders;
use App\Models\Funcion;
use Illuminate\Database\Seeder;

class FuncionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['descripcion' => 'Admin'],
            ['descripcion' => 'Facultativo'],
            ['descripcion' => 'Abastecimiento'],
            ['descripcion' => 'Vendedor'],
        ];
        foreach($datos as $conce){
            Funcion::create($conce);
        }
    }
}

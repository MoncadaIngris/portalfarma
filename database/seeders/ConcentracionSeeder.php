<?php

namespace Database\Seeders;
use App\Models\Concentracion;
use Illuminate\Database\Seeder;

class ConcentracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['descripcion' => 'Sin concentracion'],
            ['descripcion' => '250 mg'],
            ['descripcion' => '500 mg'],
            ['descripcion' => '1000 mg'],
        ];
        foreach($datos as $conce){
            Concentracion::create($conce);
        }
    }
}

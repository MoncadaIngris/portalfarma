<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Impuesto;

class ImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['descripcion' => 'Excento','valor' => 0],
            ['descripcion' => '12%','valor' => 0.12],
            ['descripcion' => '15%','valor' => 0.15],
            ['descripcion' => '18%','valor' => 0.18],
        ];
        foreach($datos as $imp){
            Impuesto::create($imp);
        }
    }
}

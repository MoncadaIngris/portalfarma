<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jornada;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['nombre' => 'Matutina','hora_entrada' => '05:00:00', 'hora_salida'=>'13:00:00' ],
            ['nombre' => 'Vespertina','hora_entrada' => '12:00:00', 'hora_salida'=>'20:00:00' ],
            ['nombre' => 'Alternativa','hora_entrada' => '19:00:00', 'hora_salida'=>'01:00:00' ],
            ['nombre' => 'Medio Tiempo','hora_entrada' => '12:00:00', 'hora_salida'=>'16:00:00' ],
        ];
        foreach($datos as $imp){
            Jornada::create($imp);
        }
    }
}

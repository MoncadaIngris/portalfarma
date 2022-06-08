<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Calendario_detalle;
class CalendarioDetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($j=1; $j < 6; $j++) { 
            for ($i=2; $i < 8; $i++) { 
                Calendario_detalle::create(
                    [
                        'id_empleado' => $i,
                        'id_calendario' => $j,
                        'id_jornada' => 1,
                    ]
                );
            }
            for ($i=8; $i < 16; $i++) { 
                Calendario_detalle::create(
                    [
                        'id_empleado' => $i,
                        'id_calendario' => $j,
                        'id_jornada' => 2,
                    ]
                );
            }
            for ($i=16; $i < 24; $i++) { 
                Calendario_detalle::create(
                    [
                        'id_empleado' => $i,
                        'id_calendario' => $j,
                        'id_jornada' => 3,
                    ]
                );
            }
            for ($i=24; $i < 32; $i++) { 
                Calendario_detalle::create(
                    [
                        'id_empleado' => $i,
                        'id_calendario' => $j,
                        'id_jornada' => 1,
                    ]
                );
            }
        }
        
    }
}

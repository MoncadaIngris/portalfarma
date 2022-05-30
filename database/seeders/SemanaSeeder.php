<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semana;

class SemanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['fecha_inicio' => '2022-05-09','fecha_final' => '2022-05-15' ],
            ['fecha_inicio' => '2022-05-16','fecha_final' => '2022-05-22' ],
            ['fecha_inicio' => '2022-05-23','fecha_final' => '2022-05-29' ],
            ['fecha_inicio' => '2022-05-30','fecha_final' => '2022-06-05' ],
        ];
        foreach($datos as $imp){
            Semana::create($imp);
        }
    }
}

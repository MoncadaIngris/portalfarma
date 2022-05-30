<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Calendario;

class CalendarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['id_semana' => 1 ],
            ['id_semana' => 2 ],
            ['id_semana' => 3 ],
            ['id_semana' => 4 ],
        ];
        foreach($datos as $imp){
            Calendario::create($imp);
        }
    }
}

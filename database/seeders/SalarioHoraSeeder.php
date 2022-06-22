<?php

namespace Database\Seeders;
use App\Models\SalarioHora;
use Illuminate\Database\Seeder;

class SalarioHoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datos=[
            ['id_cargo' => 1, 'salario_hora' => 83.33, 'salario_dia' => 666.67],
            ['id_cargo' => 2, 'salario_hora' => 83.33, 'salario_dia' => 666.67],
            ['id_cargo' => 3, 'salario_hora' => 72.92, 'salario_dia' => 583.33],
            ['id_cargo' => 4, 'salario_hora' => 62.50, 'salario_dia' => 500.00],
            ['id_cargo' => 5, 'salario_hora' => 62.50, 'salario_dia' => 500.00],
        ];
        foreach($datos as $conce){
            SalarioHora::create($conce);
        }
    }
}

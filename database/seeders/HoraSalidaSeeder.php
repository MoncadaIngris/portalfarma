<?php

namespace Database\Seeders;
use App\Models\Hora_salida;
use Illuminate\Database\Seeder;

class HoraSalidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hora_salida::Factory(570)->create();
    }
}

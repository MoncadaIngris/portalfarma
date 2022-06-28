<?php

namespace Database\Seeders;
use App\Models\Hora_entrada;
use Illuminate\Database\Seeder;

class HoraEntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hora_entrada::Factory(570)->create();
    }
}

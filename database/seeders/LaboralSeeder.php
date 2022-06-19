<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laboral;
class LaboralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $k = 1;
        for ($j=6; $j < 18; $j++) { 
            for ($i=1; $i <= 30; $i++) { 
                Laboral::create(
                    [
                        'id_empleado' => $i,
                        'fecha' => '2022-06-'.$j,
                        'id_he' => $k,
                        'id_hs' => $k,
                    ]
                );
                $k++;
            }
        }
    }
}

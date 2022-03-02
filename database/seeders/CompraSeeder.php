<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compra::Factory(30)->create();
    }
}

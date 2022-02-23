<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EmpleadoSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ProductoSeeder::class);

    }
}

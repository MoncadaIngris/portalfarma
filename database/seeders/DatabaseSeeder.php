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
        $this->call(CargoSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ConcentracionSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ImpuestoSeeder::class);
        $this->call(FuncionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ModeloSeeder::class);
        $this->call(ParteSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleHasPermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JornadaSeeder::class);
        $this->call(SemanaSeeder::class);
        $this->call(CalendarioSeeder::class);
        $this->call(CalendarioDetalleSeeder::class);
    }
}

<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'PortalFarma',
                'email' => 'portalfarma@gmail.com',
                'password' => bcrypt('00000000'),
                'estado' => 1,
                'id_empleado' => 1,
            ]
        )->assignRole('Desarrollador');

        User::create(
            [
                'name' => 'Ingris Neptalia Carcamo Moncada',
                'email' => 'ingrismoncada@gmail.com',
                'password' => bcrypt('00000000'),
                'estado' => 1,
                'id_empleado' => 2,
            ]
        )->assignRole('Admin');

        User::create(
            [
                'name' => 'Ruth Abigail Fonseca Reconco ',
                'email' => 'fonsecaruth98@gmail.com',
                'password' => bcrypt('00000000'),
                'estado' => 1,
                'id_empleado' => 3,
            ]
        )->assignRole('Abastecimiento');

        User::create(
            [
                'name' => 'Juan Vallecillo',
                'email' => 'juanillooe@gmail.com',
                'password' => bcrypt('00000000'),
                'estado' => 1,
                'id_empleado' => 4,
            ]
        )->assignRole('Vendedor');

        User::create(
            [
                'name' => 'Estefany Yissel López',
                'email' => 'estefanyyissel@gmail.com',
                'password' => bcrypt('00000000'),
                'estado' => 1,
                'id_empleado' => 5,
            ]
        )->assignRole('Facultativo');

        User::create(
            [
                'name' => 'Jorge Enrique gonzalez',
                'email' => 'jorgeenriquegonzalez6@gmail.com',
                'password' => bcrypt('00000000'),
                'estado' => 1,
                'id_empleado' => 6,
            ]
        )->assignRole('Vendedor');
    }
}

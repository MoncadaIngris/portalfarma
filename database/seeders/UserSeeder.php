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
                'id_empleado' => 1,
            ]
        )->assignRole('Desarrollador');

        User::create(
            [
                'name' => 'PortalFarma01',
                'email' => 'portalfarma01@gmail.com',
                'password' => bcrypt('00000000'),
                'id_empleado' => 1,
            ]
        )->assignRole('Admin');

        User::create(
            [
                'name' => 'PortalFarma02',
                'email' => 'portalfarma02@gmail.com',
                'password' => bcrypt('00000000'),
                'id_empleado' => 1,
            ]
        )->assignRole('Abastecimiento');

        User::create(
            [
                'name' => 'PortalFarma03',
                'email' => 'portalfarma03@gmail.com',
                'password' => bcrypt('00000000'),
                'id_empleado' => 1,
            ]
        )->assignRole('Vendedor');

        User::create(
            [
                'name' => 'PortalFarma04',
                'email' => 'portalfarma04@gmail.com',
                'password' => bcrypt('00000000'),
                'id_empleado' => 1,
            ]
        )->assignRole('Facultativo');
    }
}

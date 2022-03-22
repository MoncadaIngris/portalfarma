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
                'id_funcion' => 1,
            ]
        );
    }
}

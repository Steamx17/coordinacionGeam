<?php

namespace Database\Seeders;

use App\Models\departamento;
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
                'name' => 'Edison Guzman',
                'username' => 'Edison',
                'email' => 'Edisonvpn17@gmail.com',
                'password' => bcrypt('151215Edison@')
            ]
        )->assignRole('Administrador');

        User::create(
            [
                'name' => 'Coordinador',
                'username' => 'Coordinador',
                'email' => 'Coordinador@gmail.com',
                'password' => bcrypt('151215Edison@')
            ]
        )->assignRole('Coordinador');

        User::create(
            [
                'name' => 'Docente',
                'username' => 'Docente',
                'email' => 'Docente@gmail.com',
                'password' => bcrypt('151215Edison@')
            ]
        )->assignRole('Docente');
       // User::factory(99)->create();
    }
}

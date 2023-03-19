<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Miguel Uicab',
            'email' => 'mortmr9@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Carnaval 2023',
            'email' => 'Mgbh00@gmail.com',
            'password' => bcrypt('cnv2023')
        ])->assignRole('Administrador');

        User::create([
            'name' => 'SANDRA ROJAS',
            'email' => 'juez1@gmail.com',
            'password' => bcrypt('cn23je01')
        ])->assignRole('Votante');

        User::create([
            'name' => 'CLAUDIA SOTO',
            'email' => 'juez2@gmail.com',
            'password' => bcrypt('cn23je02')
        ])->assignRole('Votante');

        User::create([
            'name' => 'MIKE MORALES',
            'email' => 'juez3@gmail.com',
            'password' => bcrypt('cn23je03')
        ])->assignRole('Votante');

        User::create([
            'name' => 'BETO ALIFHT',
            'email' => 'juez4@gmail.com',
            'password' => bcrypt('cn23je04')
        ])->assignRole('Votante');

        User::create([
            'name' => 'KAREN VEGA LUCAS',
            'email' => 'juez5@gmail.com',
            'password' => bcrypt('cn23je05')
        ])->assignRole('Votante');

        User::create([
            'name' => 'LAURA CANO',
            'email' => 'juez6@gmail.com',
            'password' => bcrypt('cn23je06')
        ])->assignRole('Votante');

        User::create([
            'name' => 'GABRIELA MENDOZA',
            'email' => 'juez7@gmail.com',
            'password' => bcrypt('cn23je07')
        ])->assignRole('Votante');

        User::create([
            'name' => 'MISAEL LANDA',
            'email' => 'juez8@gmail.com',
            'password' => bcrypt('cn23je08')
        ])->assignRole('Votante');


    }
}

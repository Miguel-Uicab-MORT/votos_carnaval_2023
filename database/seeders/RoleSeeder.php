<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Votante']);


        $permission1 = Permission::create(['name' => 'encuestas.index'])->syncRoles([$role1]);
        $permission2 = Permission::create(['name' => 'encuestas.show'])->syncRoles([$role1]);
        $permission3 = Permission::create(['name' => 'participantes.index'])->syncRoles([$role1]);
        $permission4 = Permission::create(['name' => 'resultados.index'])->syncRoles([$role1]);
        $permission5 = Permission::create(['name' => 'resultados.show'])->syncRoles([$role1]);
        $permission6 = Permission::create(['name' => 'votos.encuesta'])->syncRoles([$role1, $role2]);
        $permission7 = Permission::create(['name' => 'votos.participante'])->syncRoles([$role1, $role2]);
        $permission8 = Permission::create(['name' => 'votos.preguntas'])->syncRoles([$role1, $role2]);
    }
}

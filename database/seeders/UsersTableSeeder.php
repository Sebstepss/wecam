<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Crear roles si aún no existen
        $usuarioRole = Role::firstOrCreate(['name' => 'usuario']);
        $streamerRole = Role::firstOrCreate(['name' => 'streamer']);

        // Crear 5 usuarios con el rol "usuario"
        User::factory(5)->create()->each(function ($user) use ($usuarioRole) {
            $user->roles()->attach($usuarioRole);
        });

        // Crear 5 usuarios con el rol "streamer"
        User::factory(5)->create()->each(function ($user) use ($streamerRole) {
            $user->roles()->attach($streamerRole);
        });
    }
}

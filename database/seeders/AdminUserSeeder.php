<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the fixed administrator account used to access /admin.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'administrador@legajocreater.com'],
            [
                'nombre' => 'Administrador',
                'apellido' => 'Sistema',
                'laboratorio' => 'Colegio',
                'password' => 'contraseña',
                'role' => UserRole::Administrador,
            ],
        );
    }
}

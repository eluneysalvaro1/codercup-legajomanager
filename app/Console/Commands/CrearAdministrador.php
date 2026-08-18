<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class CrearAdministrador extends Command
{
    protected $signature = 'admin:crear
        {--nombre= : Nombre}
        {--apellido= : Apellido}
        {--email= : Email de acceso}
        {--password= : Contraseña (mínimo 8 caracteres)}';

    protected $description = 'Crea un usuario administrador para el panel /admin.';

    public function handle(): int
    {
        $nombre = $this->option('nombre') ?: text('Nombre', required: true);
        $apellido = $this->option('apellido') ?: text('Apellido', required: true);
        $email = $this->option('email') ?: text('Email', required: true);
        $plainPassword = $this->option('password') ?: password('Contraseña (mínimo 8 caracteres)', required: true);

        $validator = Validator::make(
            [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'email' => $email,
                'password' => $plainPassword,
            ],
            [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8'],
            ],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $admin = User::create([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'laboratorio' => 'Colegio',
            'password' => $plainPassword,
            'role' => UserRole::Administrador,
        ]);

        $this->info("Administrador #{$admin->id} creado correctamente ({$admin->email}).");

        return self::SUCCESS;
    }
}

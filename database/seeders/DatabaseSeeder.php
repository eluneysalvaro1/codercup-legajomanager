<?php

namespace Database\Seeders;

use App\Models\HabilitacionLaboratorio;
use App\Models\Matricula;
use App\Models\Sss;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminUserSeeder::class);

        // Los colegiados de prueba de acá abajo son solo para desarrollo local:
        // en producción los colegiados se crean únicamente vía POST /api/colegiados.
        if (! app()->isProduction()) {
            $this->seedColegiadosDeEjemplo();
        }
    }

    private function seedColegiadosDeEjemplo(): void
    {
        // Colegiado con el legajo completo.
        $completo = User::factory()->colegiado()->create([
            'nombre' => 'Ana',
            'apellido' => 'Gómez',
            'email' => 'ana.gomez@codercup.test',
        ]);
        Matricula::factory()->for($completo)->create();
        Sss::factory()->for($completo)->create();
        HabilitacionLaboratorio::factory()->for($completo)->create();

        // Colegiado con legajo parcial (matrícula y SSS, falta habilitación).
        $parcial = User::factory()->colegiado()->create([
            'nombre' => 'Bruno',
            'apellido' => 'Fernández',
            'email' => 'bruno.fernandez@codercup.test',
        ]);
        Matricula::factory()->for($parcial)->create();
        Sss::factory()->for($parcial)->create();

        // Colegiado sin ningún documento cargado todavía.
        User::factory()->colegiado()->create([
            'nombre' => 'Carla',
            'apellido' => 'Díaz',
            'email' => 'carla.diaz@codercup.test',
        ]);
    }
}

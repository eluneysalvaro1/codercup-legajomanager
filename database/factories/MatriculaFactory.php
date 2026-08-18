<?php

namespace Database\Factories;

use App\Models\Matricula;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<Matricula>
 */
class MatriculaFactory extends Factory
{
    protected $model = Matricula::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = 'matriculas/seed/'.Str::uuid()->toString().'.txt';

        Storage::disk(config('filesystems.legajos_disk'))->put($path, 'Documento de matrícula de prueba (seeder).');

        return [
            'fecha_expedicion' => fake()->dateTimeBetween('-2 years', 'now'),
            'archivo_path' => $path,
        ];
    }
}

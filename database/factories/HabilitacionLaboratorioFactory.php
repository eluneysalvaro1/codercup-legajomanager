<?php

namespace Database\Factories;

use App\Models\HabilitacionLaboratorio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<HabilitacionLaboratorio>
 */
class HabilitacionLaboratorioFactory extends Factory
{
    protected $model = HabilitacionLaboratorio::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = 'habilitaciones/seed/'.Str::uuid()->toString().'.txt';

        Storage::disk(config('filesystems.legajos_disk'))->put($path, 'Documento de habilitación de laboratorio de prueba (seeder).');

        return [
            'fecha_expedicion' => fake()->dateTimeBetween('-2 years', 'now'),
            'archivo_path' => $path,
        ];
    }
}

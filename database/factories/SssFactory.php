<?php

namespace Database\Factories;

use App\Models\Sss;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<Sss>
 */
class SssFactory extends Factory
{
    protected $model = Sss::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $path = 'sss/seed/'.Str::uuid()->toString().'.txt';

        Storage::disk(config('filesystems.legajos_disk'))->put($path, 'Documento de SSS de prueba (seeder).');

        return [
            'numero_inscripcion' => fake()->numerify('SSS-########'),
            'fecha_expedicion' => fake()->dateTimeBetween('-2 years', 'now'),
            'archivo_path' => $path,
        ];
    }
}

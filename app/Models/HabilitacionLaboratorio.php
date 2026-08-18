<?php

namespace App\Models;

use App\Models\Concerns\CalculaVencimiento;
use Database\Factories\HabilitacionLaboratorioFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'fecha_expedicion', 'fecha_vencimiento', 'archivo_path'])]
class HabilitacionLaboratorio extends Model
{
    /** @use HasFactory<HabilitacionLaboratorioFactory> */
    use CalculaVencimiento, HasFactory;

    protected $table = 'habilitaciones_laboratorio';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_expedicion' => 'date',
            'fecha_vencimiento' => 'date',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\CalculaVencimiento;
use Database\Factories\SssFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'numero_inscripcion', 'fecha_expedicion', 'fecha_vencimiento', 'archivo_path'])]
class Sss extends Model
{
    /** @use HasFactory<SssFactory> */
    use CalculaVencimiento, HasFactory;

    protected $table = 'sss';

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

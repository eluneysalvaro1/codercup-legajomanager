<?php

namespace App\Models\Concerns;

/**
 * Calcula fecha_vencimiento = fecha_expedicion + 5 años en el modelo, para que
 * el cálculo sea consistente sin importar por dónde se guarde el registro.
 */
trait CalculaVencimiento
{
    protected static function bootCalculaVencimiento(): void
    {
        static::saving(function (self $model): void {
            $model->fecha_vencimiento = $model->fecha_expedicion?->copy()->addYears(5);
        });
    }
}

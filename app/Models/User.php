<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nombre', 'apellido', 'email', 'laboratorio', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->role === UserRole::Administrador,
            'panel' => $this->role === UserRole::Colegiado,
            default => false,
        };
    }

    public function getFilamentName(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }

    /**
     * @return HasOne<Matricula, $this>
     */
    public function matricula(): HasOne
    {
        return $this->hasOne(Matricula::class);
    }

    /**
     * @return HasOne<Sss, $this>
     */
    public function sss(): HasOne
    {
        return $this->hasOne(Sss::class);
    }

    /**
     * @return HasOne<HabilitacionLaboratorio, $this>
     */
    public function habilitacionLaboratorio(): HasOne
    {
        return $this->hasOne(HabilitacionLaboratorio::class);
    }
}

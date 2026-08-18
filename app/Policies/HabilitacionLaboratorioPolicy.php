<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\HabilitacionLaboratorio;
use App\Models\User;

class HabilitacionLaboratorioPolicy
{
    public function view(User $user, HabilitacionLaboratorio $habilitacionLaboratorio): bool
    {
        return $user->role === UserRole::Administrador || $habilitacionLaboratorio->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::Colegiado;
    }

    public function update(User $user, HabilitacionLaboratorio $habilitacionLaboratorio): bool
    {
        return $user->role === UserRole::Colegiado && $habilitacionLaboratorio->user_id === $user->id;
    }

    public function delete(User $user, HabilitacionLaboratorio $habilitacionLaboratorio): bool
    {
        return false;
    }
}

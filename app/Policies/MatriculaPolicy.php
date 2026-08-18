<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Matricula;
use App\Models\User;

class MatriculaPolicy
{
    public function view(User $user, Matricula $matricula): bool
    {
        return $user->role === UserRole::Administrador || $matricula->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::Colegiado;
    }

    public function update(User $user, Matricula $matricula): bool
    {
        return $user->role === UserRole::Colegiado && $matricula->user_id === $user->id;
    }

    public function delete(User $user, Matricula $matricula): bool
    {
        return false;
    }
}

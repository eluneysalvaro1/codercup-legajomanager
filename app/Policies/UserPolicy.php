<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class UserPolicy
{
    /**
     * El panel de administrador es de solo lectura sobre los legajos de colegiados.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === UserRole::Administrador;
    }

    public function view(User $user, User $model): bool
    {
        return $user->role === UserRole::Administrador;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, User $model): bool
    {
        return false;
    }

    public function delete(User $user, User $model): bool
    {
        return false;
    }

    public function restore(User $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}

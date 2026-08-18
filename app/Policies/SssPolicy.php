<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Sss;
use App\Models\User;

class SssPolicy
{
    public function view(User $user, Sss $sss): bool
    {
        return $user->role === UserRole::Administrador || $sss->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::Colegiado;
    }

    public function update(User $user, Sss $sss): bool
    {
        return $user->role === UserRole::Colegiado && $sss->user_id === $user->id;
    }

    public function delete(User $user, Sss $sss): bool
    {
        return false;
    }
}

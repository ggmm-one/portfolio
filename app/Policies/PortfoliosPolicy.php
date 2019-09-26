<?php

namespace App\Policies;

use App\User;
use App\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortfoliosPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return !$user->role->portfoliosNone();
    }

    public function view(User $user, Model $model)
    {
        return !$user->role->portfoliosNone();
    }

    public function create(User $user)
    {
        return $user->role->portfoliosAll();
    }

    public function update(User $user, Model $model)
    {
        return $user->role->portfoliosAll();
    }

    public function delete(User $user, Model $model)
    {
        return $user->role->portfoliosAll();
    }

    public function restore(User $user, Model $model)
    {
        return $user->role->portfoliosAll();
    }

    public function forceDelete(User $user, Model $model)
    {
        return $user->role->portfoliosAll();
    }
}

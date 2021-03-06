<?php

namespace App\Policies;

use App\Model;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortfoliosModulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return ! $user->role->portfoliosNone();
    }

    public function view(User $user, Model $model)
    {
        return ! $user->role->portfoliosNone();
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
        return ! $model->isRoot() && $user->role->portfoliosAll();
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

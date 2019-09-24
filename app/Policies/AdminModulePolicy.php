<?php

namespace App\Policies;

use App\User;
use App\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminModulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return !$user->role->adminNone();
    }

    public function view(User $user, Model $model)
    {
        return !$user->role->adminNone();
    }

    public function create(User $user)
    {
        return $user->role->adminAll();
    }

    public function update(User $user, Model $model)
    {
        return $user->role->adminAll();
    }

    public function delete(User $user, Model $model)
    {
        return $user->role->adminAll();
    }

    public function restore(User $user, Model $model)
    {
        return $user->role->adminAll();
    }

    public function forceDelete(User $user, Model $model)
    {
        return $user->role->adminAll();
    }
}

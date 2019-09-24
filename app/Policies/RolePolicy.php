<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return !$user->role->adminNone();
    }

    public function view(User $user, Role $model)
    {
        return !$user->role->adminNone();
    }

    public function create(User $user)
    {
        return $user->role->adminAll();
    }

    public function update(User $user, Role $model)
    {
        return $user->role->adminAll();
    }

    public function delete(User $user, Role $model)
    {
        return $user->role->adminAll();
    }

    public function restore(User $user, Role $model)
    {
        return $user->role->adminAll();
    }

    public function forceDelete(User $user, Role $model)
    {
        return $user->role->adminAll();
    }
}

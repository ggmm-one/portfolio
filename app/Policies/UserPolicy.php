<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return !$user->role->adminNone();
    }

    public function view(User $user, User $model)
    {
        return !$user->role->adminNone();
    }

    public function create(User $user)
    {
        return $user->role->adminAll();
    }

    public function update(User $user, User $model)
    {
        return $user->role->adminAll();
    }

    public function delete(User $user, User $model)
    {
        return $user->role->adminAll();
    }

    public function restore(User $user, User $model)
    {
        return $user->role->adminAll();
    }

    public function forceDelete(User $user, User $model)
    {
        return $user->role->adminAll();
    }

    public function portfoliosModule(User $user)
    {
        return $user->role->permission_portfolios != Role::PERMISSION_NONE;
    }

    public function projectsModule(User $user)
    {
        return $user->role->permission_projects != Role::PERMISSION_NONE;
    }

    public function resourcesModule(User $user)
    {
        return $user->role->permission_resources != Role::PERMISSION_NONE;
    }

    public function adminModule(User $user)
    {
        return !$user->role->adminNone();
    }
}

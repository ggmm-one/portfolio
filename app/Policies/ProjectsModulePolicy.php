<?php

namespace App\Policies;

use App\User;
use App\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectsModulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return !$user->role->projectsNone();
    }

    public function view(User $user, Model $model)
    {
        return !$user->role->projectsNone();
    }

    public function create(User $user)
    {
        return $user->role->projectsAll();
    }

    public function update(User $user, Model $model)
    {
        return $user->role->projectsAll();
    }

    public function delete(User $user, Model $model)
    {
        return $user->role->projectsAll();
    }

    public function restore(User $user, Model $model)
    {
        return $user->role->projectsAll();
    }

    public function forceDelete(User $user, Model $model)
    {
        return $user->role->projectsAll();
    }
}

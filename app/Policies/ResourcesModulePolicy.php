<?php

namespace App\Policies;

use App\Model;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcesModulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return ! $user->role->resourcesNone();
    }

    public function view(User $user, Model $model)
    {
        return ! $user->role->resourcesNone();
    }

    public function create(User $user)
    {
        return $user->role->resourcesAll();
    }

    public function update(User $user, Model $model)
    {
        return $user->role->resourcesAll();
    }

    public function delete(User $user, Model $model)
    {
        return $user->role->resourcesAll();
    }

    public function restore(User $user, Model $model)
    {
        return $user->role->resourcesAll();
    }

    public function forceDelete(User $user, Model $model)
    {
        return $user->role->resourcesAll();
    }
}

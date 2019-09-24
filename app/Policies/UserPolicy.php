<?php

namespace App\Policies;

use App\User;
use App\Role;

class UserPolicy extends AdminModulePolicy
{
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

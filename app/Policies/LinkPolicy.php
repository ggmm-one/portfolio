<?php

namespace App\Policies;

use App\Link;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class LinkPolicy
{
    use HandlesAuthorization;

    private function parent($link)
    {
        return Gate::getPolicyFor(get_class($link->linkable));
    }

    public function view(User $user, Link $link)
    {
        return $this->parent($link)->view($user, $link->linkable);
    }

    public function update(User $user, Link $link)
    {
        return $this->parent($link)->update($user, $link->linkable);
    }

    public function delete(User $user, Link $link)
    {
        return $this->parent($link)->delete($user, $link->linkable);
    }

    public function restore(User $user, Link $link)
    {
        return $this->parent($link)->restore($user, $link->linkable);
    }

    public function forceDelete(User $user, Link $link)
    {
        return $this->parent($link)->forceDelete($user, $link->linkable);
    }
}

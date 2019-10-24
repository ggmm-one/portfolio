<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class CommentPolicy
{
    use HandlesAuthorization;

    private function parent($comment)
    {
        return Gate::getPolicyFor(get_class($comment->commentable));
    }

    public function view(User $user, Comment $comment)
    {
        return $this->parent($comment)->view($user, $comment->commentable);
    }

    public function update(User $user, Comment $comment)
    {
        return $this->parent($comment)->update($user, $comment->commentable);
    }

    public function delete(User $user, Comment $comment)
    {
        return $this->parent($comment)->delete($user, $comment->commentable);
    }

    public function restore(User $user, Comment $comment)
    {
        return $this->parent($comment)->restore($user, $comment->commentable);
    }

    public function forceDelete(User $user, Comment $comment)
    {
        return $this->parent($comment)->forceDelete($user, $comment->commentable);
    }
}

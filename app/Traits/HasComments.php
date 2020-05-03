<?php

namespace App\Traits;

use App\Comment;

trait HasComments
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

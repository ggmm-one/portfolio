<?php

namespace App;

class Comment extends Model
{
    public const DD_CONTENT_LENGTH = 4000;

    protected $fillable = [
        'content',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}

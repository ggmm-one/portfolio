<?php

namespace App;

class ResourceOwner extends Model
{
    public const DD_NAME_LENGTH = 256;
    public const DD_EMAIL_LENGTH = 256;

    public const CHECK_BEFORE_DELETING = [
        [Resource::class, 'resource_owner_id', 'This owner is used in a resource(s). Please re-assign and try again.']
    ];

    protected $fillable = [
        'name', 'email'
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    public static function getSelectList()
    {
        return ResourceOwner::ordered()->get()->pluck('name', 'pid');
    }
}

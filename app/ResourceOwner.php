<?php

namespace App;

class ResourceOwner extends Model
{
    public const DD_NAME_LENGTH = 256;
    public const DD_EMAIL_LENGTH = 256;

    protected $fillable = [
        'name', 'email'
    ];

    protected $checkBeforeDeleting = [
        [Resource::class, 'resource_owner_id', 'This owner is used in a resource(s). Please re-assign and try again.']
    ];

    public static function getSelectList()
    {
        return ResourceOwner::orderBy('name')->get()->pluck('name', 'pid');
    }

}

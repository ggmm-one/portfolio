<?php

namespace App;

use App\Traits\HasComments;

class Resource extends Model
{
    use HasComments;

    public const MORPH_SHORT_NAME = 'res';

    public const DD_NAME_LENGTH = 256;
    public const DD_DESCRIPTION_LENGTH = 4000;

    protected $cascadeDelete = [
        'capacities',
        'comments',
    ];

    protected $checkReferenceBeforeDeleting = [
        'allocations',
    ];

    protected $fillable = [
        'name', 'resource_type_id', 'resource_owner_id', 'description',
    ];

    public function owner()
    {
        return $this->belongsTo(ResourceOwner::class, 'resource_owner_id');
    }

    public function type()
    {
        return $this->belongsTo(ResourceType::class, 'resource_type_id');
    }

    public function capacities()
    {
        return $this->hasMany(ResourceCapacity::class, 'resource_id');
    }

    public function allocations()
    {
        return $this->hasMany(ResourceAllocation::class, 'resource_id');
    }

    public static function getSelectList()
    {
        return self::orderBy('name')->get()->pluck('name', 'hashid');
    }
}

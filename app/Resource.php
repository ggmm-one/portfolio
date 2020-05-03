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
        'name', 'resource_type_pid', 'resource_owner_pid', 'description',
    ];

    protected $attributes = [
        'name' => 'New Resource',
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
        return $this->belongsTo(ResourceAllocation::class, 'resource_id');
    }

    public function getResourceTypePidAttribute()
    {
        return ResourceType::getPid($this->resource_type_id);
    }

    public function setResourceTypePidAttribute($value)
    {
        $this->resource_type_id = ResourceType::getId($value);
    }

    public function getResourceOwnerPidAttribute()
    {
        return ResourceOwner::getPid($this->resource_owner_id);
    }

    public function setResourceOwnerPidAttribute($value)
    {
        $this->resource_owner_id = ResourceOwner::getId($value);
    }

    public static function getSelectList()
    {
        return self::select('id', 'pid', 'name')->orderBy('name')->get()->pluck('name', 'pid');
    }
}

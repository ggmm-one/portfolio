<?php

namespace App;

class ResourceAllocation extends Model
{
    protected $fillable = [
        'resource_hashid', 'month', 'quantity', 'sort_order',
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getResourceHashidAttribute()
    {
        return $this->resource ? $this->resource->hashid : null;
    }

    public function setResourceHashidAttribute($value)
    {
        $this->attributes['resource_id'] = (new Resource)->hashidToId($value);
    }
}

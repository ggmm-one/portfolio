<?php

namespace App;

class ResourceAllocation extends Model
{
    protected $fillable = [
        'resource_pid', 'month', 'quantity', 'sort_order',
    ];

    public function getResourcePidAttribute()
    {
        return Resource::getPid($this->resource_id);
    }

    public function setResourcePidAttribute($value)
    {
        $this->attributes['resource_id'] = Resource::getId($value);
    }
}

<?php

namespace App;

class ResourceAllocation extends Model
{
    protected $fillable = [
        'resource_id', 'start', 'end', 'quantity',
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

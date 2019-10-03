<?php

namespace App;

class ProjectOrderConstraint extends Model
{
    protected $with = ['afterProject', 'beforeProject'];

    public function beforeProject()
    {
        return $this->belongsTo(Project::class, 'before_project_id');
    }

    public function afterProject()
    {
        return $this->belongsTo(Project::class, 'after_project_id');
    }
}

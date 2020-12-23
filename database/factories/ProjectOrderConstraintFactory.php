<?php

namespace Database\Factories;

use App\Project;
use App\ProjectOrderConstraint;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectOrderConstraintFactory extends Factory
{
    protected $model = ProjectOrderConstraint::class;

    public function definition()
    {
        return [
            'before_project_id' => Project::factory(),
            'after_project_id' => Project::factory(),
        ];
    }
}

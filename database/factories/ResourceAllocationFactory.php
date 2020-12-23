<?php

namespace Database\Factories;

use App\Project;
use App\Resource;
use App\ResourceAllocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceAllocationFactory extends Factory
{
    protected $model = ResourceAllocation::class;

    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'resource_id' => Resource::factory(),
        ];
    }
}

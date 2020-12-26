<?php

namespace Tests\Unit\Models;

use App\Project;
use App\Resource;
use App\ResourceAllocation;
use Tests\TestCase;

class ResourceAllocationTest extends TestCase
{
    public function testResource()
    {
        $resource = Resource::factory()->create();
        $resourceAllocation = ResourceAllocation::factory()->create([
            'resource_id' => $resource->id,
        ]);
        $this->assertInstanceOf(Resource::class, $resourceAllocation->resource);
        $this->assertEquals($resourceAllocation->resource->id, $resource->id);
    }

    public function testProject()
    {
        $project = Project::factory()->create();
        $resourceAllocation = ResourceAllocation::factory()->create([
            'project_id' => $project->id,
        ]);
        $this->assertInstanceOf(Project::class, $resourceAllocation->project);
        $this->assertEquals($project->id, $resourceAllocation->project->id);
    }
}

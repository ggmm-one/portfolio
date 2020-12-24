<?php

namespace Tests\Unit\Models;

use App\Resource;
use App\ResourceAllocation;
use App\ResourceCapacity;
use App\ResourceOwner;
use App\ResourceType;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    public function testOwner()
    {
        $owner = ResourceOwner::factory()->create();
        $resource = Resource::factory()->create(['resource_owner_id' => $owner->id]);
        $this->assertInstanceOf(ResourceOwner::class, $resource->owner);
        $this->assertEquals($resource->owner->id, $owner->id);
    }

    public function testType()
    {
        $type = ResourceType::factory()->create();
        $resource = Resource::factory()->create(['resource_type_id' => $type->id]);
        $this->assertInstanceOf(ResourceType::class, $resource->type);
        $this->assertEquals($resource->type->id, $type->id);
    }

    public function testCapacities()
    {
        $resource = Resource::factory()->create();
        $capacity = ResourceCapacity::factory()->create(['resource_id' => $resource->id]);
        $this->assertEquals(1, $resource->capacities->count());
    }

    public function testAllocations()
    {
        $resource = Resource::factory()->create();
        $allocation = ResourceAllocation::factory()->create(['resource_id' => $resource->id]);
        $this->assertEquals(1, $resource->allocations->count());
    }
}

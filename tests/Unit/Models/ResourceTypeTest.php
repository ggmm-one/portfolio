<?php

namespace Tests\Unit\Models;

use App\Resource;
use App\ResourceOwner;
use App\ResourceType;
use Tests\TestCase;

class ResourceTypeTest extends TestCase
{
    public function testResources()
    {
        $resourceOwner = ResourceOwner::factory()->create();
        $resourceType = ResourceType::factory()->create();
        $resource = Resource::factory()->create(['resource_type_id' => $resourceType->id, 'resource_owner_id' => $resourceOwner->id]);
        $this->assertEquals(1, $resourceType->resources->count());
    }
}

<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ResourceRequest;
use Tests\TestCase;

class ResourceRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new ResourceRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(4, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('resource_type_hashid', $rules);
        $this->assertArrayHasKey('resource_owner_hashid', $rules);
        $this->assertArrayHasKey('description', $rules);
    }
}

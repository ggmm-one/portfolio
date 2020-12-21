<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ResourceAllocationRequest;
use Tests\TestCase;

class ResourceAllocationRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new ResourceAllocationRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(4, $rules);
        $this->assertArrayHasKey('resource_hashid', $rules);
        $this->assertArrayHasKey('month', $rules);
        $this->assertArrayHasKey('quantity', $rules);
        $this->assertArrayHasKey('sort_order', $rules);
    }
}

<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ResourceCapacityRequest;
use Tests\TestCase;

class ResourceCapacityRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new ResourceCapacityRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(4, $rules);
        $this->assertArrayHasKey('start', $rules);
        $this->assertArrayHasKey('end', $rules);
        $this->assertArrayHasKey('type', $rules);
        $this->assertArrayHasKey('quantity', $rules);
    }
}

<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ResourceTypeRequest;
use Tests\TestCase;

class ResourceTypeRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new ResourceTypeRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(2, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('category', $rules);
    }
}

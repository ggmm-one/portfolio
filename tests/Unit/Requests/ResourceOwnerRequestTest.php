<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ResourceOwnerRequest;
use Tests\TestCase;

class ResourceOwnerRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new ResourceOwnerRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(2, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('email', $rules);
    }
}

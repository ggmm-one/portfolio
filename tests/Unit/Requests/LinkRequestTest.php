<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\LinkRequest;
use Tests\TestCase;

class LinkRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new LinkRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(3, $rules);
        $this->assertArrayHasKey('title', $rules);
        $this->assertArrayHasKey('url', $rules);
        $this->assertArrayHasKey('sort_order', $rules);
    }
}

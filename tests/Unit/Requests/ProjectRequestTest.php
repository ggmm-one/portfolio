<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ProjectRequest;
use Tests\TestCase;

class ProjectRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new ProjectRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(8, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('code', $rules);
        $this->assertArrayHasKey('portfolio_unit_hashid', $rules);
        $this->assertArrayHasKey('type', $rules);
        $this->assertArrayHasKey('status', $rules);
        $this->assertArrayHasKey('start', $rules);
        $this->assertArrayHasKey('duration', $rules);
        $this->assertArrayHasKey('description', $rules);
    }
}

<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\PortfolioRequest;
use Tests\TestCase;

class PortfolioUnitRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new PortfolioRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(3, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('description', $rules);
        $this->assertArrayHasKey('parent_id', $rules);
    }
}

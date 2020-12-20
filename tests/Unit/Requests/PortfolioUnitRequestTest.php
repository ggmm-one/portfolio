<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\PortfolioUnitRequest;
use Tests\TestCase;

class PortfolioUnitRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new PortfolioUnitRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(4, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('description', $rules);
        $this->assertArrayHasKey('type', $rules);
        $this->assertArrayHasKey('parent_hashid', $rules);
    }
}

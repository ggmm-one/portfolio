<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\EvaluationItemRequest;
use Tests\TestCase;

class EvaluationItemRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new EvaluationItemRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(4, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('instructions', $rules);
        $this->assertArrayHasKey('weight', $rules);
        $this->assertArrayHasKey('sort_order', $rules);
    }
}

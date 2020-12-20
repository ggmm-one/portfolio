<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\EvaluationScoreRequest;
use Tests\TestCase;

class EvaluationScoreRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new EvaluationScoreRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(2, $rules);
        $this->assertArrayHasKey('score', $rules);
        $this->assertArrayHasKey('description', $rules);
    }
}

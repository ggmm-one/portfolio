<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\CommentRequest;
use Tests\TestCase;

class CommentRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new CommentRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(1, $rules);
        $this->assertArrayHasKey('content', $rules);
    }
}

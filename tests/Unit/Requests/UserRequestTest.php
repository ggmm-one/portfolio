<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\UserRequest;
use Tests\TestCase;

class UserRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new UserRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(3, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('email', $rules);
        $this->assertArrayHasKey('role_hashid', $rules);
    }
}

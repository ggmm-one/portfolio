<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\RoleRequest;
use Tests\TestCase;

class RoleRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new RoleRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(5, $rules);
        $this->assertArrayHasKey('name', $rules);
        $this->assertArrayHasKey('permission_portfolios', $rules);
        $this->assertArrayHasKey('permission_projects', $rules);
        $this->assertArrayHasKey('permission_resources', $rules);
        $this->assertArrayHasKey('permission_admin', $rules);
    }
}

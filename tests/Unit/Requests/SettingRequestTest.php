<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\SettingRequest;
use Tests\TestCase;

class SettingRequestTest extends TestCase
{
    public function testRules()
    {
        $request = new SettingRequest();
        $rules = $request->rules();
        $this->assertTrue($request->authorize());
        $this->assertCount(1, $rules);
        $this->assertArrayHasKey('evaluation_max', $rules);
    }
}

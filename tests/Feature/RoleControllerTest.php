<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Unit\Models;

use App\Role;
use App\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public function testUsers()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id]);
        $this->assertEquals(1, $role->users->count());
    }
}

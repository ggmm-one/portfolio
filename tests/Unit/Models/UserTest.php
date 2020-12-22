<?php

namespace Tests\Unit\Models;

use App\Role;
use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRole()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id]);
        $this->assertInstanceOf(Role::class, $user->role);
        $this->assertEquals($user->role->id, $role->id);
    }
}

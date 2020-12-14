<?php

namespace Database\Factories;

use App\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'permission_portfolios' => Arr::random(array_keys(Role::PERMISSIONS)),
            'permission_projects' => Arr::random(array_keys(Role::PERMISSIONS)),
            'permission_resources' => Arr::random(array_keys(Role::PERMISSIONS)),
            'permission_admin' => Arr::random(array_keys(Role::PERMISSIONS)),
        ];
    }
}

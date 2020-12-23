<?php

namespace Database\Factories;

use App\Resource;
use App\ResourceOwner;
use App\ResourceType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    protected $model = Resource::class;

    public function definition()
    {
        return [
            'resource_owner_id' => ResourceOwner::factory(),
            'resource_type_id' => ResourceType::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
        ];
    }
}

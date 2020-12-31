<?php

namespace Database\Factories;

use App\Resource;
use App\ResourceCapacity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceCapacityFactory extends Factory
{
    protected $model = ResourceCapacity::class;

    public function definition()
    {
        return [
            'resource_id' => Resource::factory(),
            'start' => $this->faker->date,
            'end' => $this->faker->date,
            'quantity' => $this->faker->numberBetween(5, 1000),
        ];
    }
}

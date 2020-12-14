<?php

namespace Database\Factories;

use App\ResourceCapacity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ResourceCapacityFactory extends Factory
{
    protected $model = ResourceCapacity::class;

    public function definition()
    {
        return [
            'start' => $this->faker->date,
            'end' => $this->faker->date,
            'type' => Arr::random(array_keys(ResourceCapacity::TYPES)),
            'quantity' => $this->faker->numberBetween(5, 1000),
        ];
    }
}

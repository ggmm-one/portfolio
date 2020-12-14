<?php

namespace Database\Factories;

use App\ResourceType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ResourceTypeFactory extends Factory
{
    protected $model = ResourceType::class;

    public function definition()
    {
        return [
            'category' => Arr::random(array_keys(ResourceType::CATEGORIES)),
            'name' => $this->faker->unique()->sentence(2),
        ];
    }
}

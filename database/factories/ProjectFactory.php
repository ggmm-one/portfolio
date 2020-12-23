<?php

namespace Database\Factories;

use App\PortfolioUnit;
use App\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'type' => Arr::random(array_keys(Project::TYPES)),
            'status' => Arr::random(array_keys(Project::STATUS)),
            'name' => $this->faker->words(3, true),
            'code' => $this->faker->optional(0.5)->ean8,
            'start' =>$this->faker->optional(0.5)->dateTime,
            'duration' => $this->faker->numberBetween(1, 12),
            'description' => $this->faker->paragraph,
            'score' => $this->faker->numberBetween(1, 10),
            'portfolio_unit_id' => PortfolioUnit::factory(),
        ];
    }
}

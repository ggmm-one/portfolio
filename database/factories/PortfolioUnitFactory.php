<?php

namespace Database\Factories;

use App\PortfolioUnit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PortfolioUnitFactory extends Factory
{
    protected $model = PortfolioUnit::class;

    public function definition()
    {
        return [
            'type' => Arr::random(array_keys(PortfolioUnit::TYPES)),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
        ];
    }
}

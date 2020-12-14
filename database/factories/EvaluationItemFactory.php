<?php

namespace Database\Factories;

use App\EvaluationItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationItemFactory extends Factory
{
    protected $model = EvaluationItem::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'instructions' => $this->faker->sentence(4),
            'weight' => $this->faker->numberBetween(5, 20),
            'weight_factor' => $this->faker->numberBetween(5, 20),
            'sort_order' => $this->faker->numberBetween(1, 30),
        ];
    }
}

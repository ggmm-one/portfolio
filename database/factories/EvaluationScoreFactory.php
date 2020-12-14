<?php

namespace Database\Factories;

use App\EvaluationScore;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvaluationScoreFactory extends Factory
{
    protected $model = EvaluationScore::class;

    public function definition()
    {
        return [
            'score' => $this->faker->numberBetween(1, 10),
            'weighted_score' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->paragraph(),
        ];
    }
}

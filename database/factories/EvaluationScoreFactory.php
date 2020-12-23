<?php

namespace Database\Factories;

use App\EvaluationItem;
use App\EvaluationScore;
use App\Project;
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
            'project_id' => Project::factory(),
            'evaluation_item_id' => EvaluationItem::factory(),
        ];
    }
}

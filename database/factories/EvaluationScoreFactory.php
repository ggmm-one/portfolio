<?php

use App\EvaluationScore;
use Faker\Generator as Faker;

$factory->define(EvaluationScore::class, function (Faker $faker) {
    return [
        'score' => $faker->numberBetween(1, 10),
        'weighted_score' => $faker->numberBetween(1, 10),
        'description' => $faker->paragraph()
    ];
});

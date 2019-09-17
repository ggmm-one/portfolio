<?php

use Faker\Generator as Faker;
use App\Project;
use Illuminate\Support\Arr;

$factory->define(Project::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    $faker->addProvider(new Lorem($faker));
    return Timestamps::appendTimestamps($faker, [
        'type' => Arr::random(array_keys(Project::TYPES)),
        'status' => Arr::random(array_keys(Project::STATUS)),
        'name' => $faker->loremTitle,
        'code' => $faker->optional(0.5)->ean8,
        'start' =>$faker->optional(0.5)->dateTime,
        'duration' => $faker->numberBetween(1, 12),
        'description' => $faker->paragraph,
        'score' => $faker->numberBetween(1, 10)
    ]);
});

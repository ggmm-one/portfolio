<?php

use App\ResourceType;
use Faker\Generator as Faker;

$factory->define(ResourceType::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));

    return Timestamps::appendTimestamps($faker, [
        'category' => Arr::random(array_keys(ResourceType::CATEGORIES)),
        'name' => $faker->unique()->sentence(2),
    ]);
});

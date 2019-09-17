<?php

use App\ResourceType;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ResourceType::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    return Timestamps::appendTimestamps($faker, [
        'pid' => Str::random(11),
        'category' => Arr::random(array_keys(ResourceType::CATEGORIES)),
        'name' => $faker->unique()->sentence(2),
    ]);
});

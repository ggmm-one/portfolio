<?php

use App\ResourceCapacity;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(ResourceCapacity::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    return Timestamps::appendTimestamps($faker, [
        'pid' => Str::random(11),
        'start' => $faker->sequentialDate,
        'end' => $faker->sequentialDate,
        'type' => Arr::random(array_keys(ResourceCapacity::TYPES)),
        'quantity' => $faker->numberBetween(5,1000)
    ]);
});

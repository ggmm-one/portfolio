<?php

use App\PortfolioUnit;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(PortfolioUnit::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    $faker->addProvider(new Lorem($faker));

    return Timestamps::appendTimestamps($faker, [
        'type' => Arr::random(array_keys(PortfolioUnit::TYPES)),
        'name' => $faker->loremTitle,
        'description' => $faker->paragraph(),
    ]);
});

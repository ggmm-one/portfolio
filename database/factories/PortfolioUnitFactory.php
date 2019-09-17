<?php

use App\PortfolioUnit;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

$factory->define(PortfolioUnit::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    $faker->addProvider(new Lorem($faker));
    return Timestamps::appendTimestamps($faker, [
        'pid' => Str::random(11),
        'type' => Arr::random(array_keys(PortfolioUnit::TYPES)),
        'name' => $faker->loremTitle,
        'description' => $faker->paragraph()
    ]);
});

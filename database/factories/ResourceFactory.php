<?php

use App\Resource;
use Faker\Generator as Faker;

$factory->define(Resource::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    $faker->addProvider(new Lorem($faker));
    return Timestamps::appendTimestamps($faker, [
        'name' => $faker->loremTitle,
        'description' => $faker->paragraph()
    ]);
});

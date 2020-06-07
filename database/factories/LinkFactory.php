<?php

use App\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    $faker->addProvider(new Lorem($faker));

    return Timestamps::appendTimestamps($faker, [
        'title' => $faker->loremTitle,
        'url' => $faker->url,
    ]);
});

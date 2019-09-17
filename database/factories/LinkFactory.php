<?php

use App\Link;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Link::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    $faker->addProvider(new Lorem($faker));
    return Timestamps::appendTimestamps($faker, [
        'pid' => Str::random(11),
        'title' => $faker->loremTitle,
        'url' => $faker->url
    ]);
});

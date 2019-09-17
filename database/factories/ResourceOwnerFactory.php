<?php

use App\ResourceOwner;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ResourceOwner::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));
    $faker->addProvider(new Timestamps($faker));
    return Timestamps::appendTimestamps($faker, [
        'pid' => Str::random(11),
        'name' => $faker->name,
        'email' => $faker->safeEmail,
    ]);
});

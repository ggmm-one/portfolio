<?php

use App\ResourceOwner;
use Faker\Generator as Faker;

$factory->define(ResourceOwner::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));
    $faker->addProvider(new Timestamps($faker));

    return Timestamps::appendTimestamps($faker, [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
    ]);
});

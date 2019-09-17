<?php

use App\Organization;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    return [
        'pid' => Str::random(11),
        'name' => $faker->company,
        'created_at' => $faker->createdAt,
        'updated_at' => $faker->updatedAt
    ];
});

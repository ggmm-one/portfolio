<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));

    return [
        'evaluation_max' => $faker->numberBetween(3, 10),
        'created_at' => $faker->createdAt,
        'updated_at' => $faker->updatedAt,
    ];
});

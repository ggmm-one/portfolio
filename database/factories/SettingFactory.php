<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Setting::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    return [
        'pid' => Str::random(11),
        'evaluation_max' => $faker->numberBetween(3,10),
        'created_at' => $faker->createdAt,
        'updated_at' => $faker->updatedAt
    ];
});

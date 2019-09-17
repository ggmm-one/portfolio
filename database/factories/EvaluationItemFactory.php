<?php

use App\EvaluationItem;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(EvaluationItem::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    $faker->addProvider(new Lorem($faker));
    return Timestamps::appendTimestamps($faker, [
        'pid' => Str::random(11),
        'name' => $faker->loremTitle,
        'instructions' => $faker->sentence(4),
        'weight' => $faker->numberBetween(5,20),
        'weight_factor' => $faker->numberBetween(5,20),
        'sort_order' => $faker->numberBetween(1,30)
    ]);
});

<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));
    return Timestamps::appendTimestamps($faker, [
        'pid' => Str::random(11),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => $faker->dateTime,
        'password' => '$2y$10$/X8Opco2jiLLPuBE2Il6h.NjBDEoOZ8o8RKZtE.ZGUQclCDdyfqTe', //passwd
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ]);
});

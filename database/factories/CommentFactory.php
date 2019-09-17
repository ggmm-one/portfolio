<?php

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $faker->addProvider(new Person($faker));
    return Timestamps::appendTimestamps($faker, [
        'content' => $faker->paragraph(3)
    ]);
});

<?php

use App\Role;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Role::class, function (Faker $faker) {
    $faker->addProvider(new Timestamps($faker));
    $faker->addProvider(new Lorem($faker));

    return [
        'name' => $faker->loremTitle,
        'permission_portfolios' => Arr::random(array_keys(Role::PERMISSIONS)),
        'permission_projects' => Arr::random(array_keys(Role::PERMISSIONS)),
        'permission_resources' => Arr::random(array_keys(Role::PERMISSIONS)),
        'permission_admin' => Arr::random(array_keys(Role::PERMISSIONS)),
        'created_at' => $faker->createdAt,
        'updated_at' => $faker->updatedAt,
    ];
});

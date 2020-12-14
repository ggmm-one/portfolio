<?php

namespace Database\Factories;

use App\ResourceOwner;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceOwnerFactory extends Factory
{
    protected $model = ResourceOwner::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
        ];
    }
}

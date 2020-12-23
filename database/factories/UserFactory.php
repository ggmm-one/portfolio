<?php

namespace Database\Factories;

use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->dateTime,
            'password' => '$2y$10$/X8Opco2jiLLPuBE2Il6h.NjBDEoOZ8o8RKZtE.ZGUQclCDdyfqTe', //passwd
            'role_id' => Role::factory(),
        ];
    }
}

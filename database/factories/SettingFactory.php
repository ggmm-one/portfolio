<?php

namespace Database\Factories;

use App\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition()
    {
        return [
            'evaluation_max' => $this->faker->numberBetween(3, 10),
        ];
    }
}

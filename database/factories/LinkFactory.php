<?php

namespace Database\Factories;

use App\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'url' => $this->faker->url,
        ];
    }
}

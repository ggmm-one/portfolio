<?php

namespace Database\Factories;

use App\Link;
use App\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition()
    {
        return [
            'linkable_id' => Project::factory()->create(),
            'linkable_type' => Project::MORPH_SHORT_NAME,
            'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_GOAL,
            'title' => $this->faker->words(3, true),
            'url' => $this->faker->url,
        ];
    }
}

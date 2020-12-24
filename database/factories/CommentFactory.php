<?php

namespace Database\Factories;

use App\Comment;
use App\Project;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'content' => $this->faker->paragraph(3),
            'commentable_id' => Project::factory(),
            'commentable_type' => Project::MORPH_SHORT_NAME,
        ];
    }
}

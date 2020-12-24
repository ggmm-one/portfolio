<?php

namespace Tests\Unit\Models;

use App\Comment;
use App\Project;
use App\User;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testAuthor()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);
        $this->assertInstanceOf(User::class, $comment->author);
        $this->assertEquals($comment->author->id, $user->id);
    }

    public function testCommentable()
    {
        $project = Project::factory()->create();
        $comment = Comment::factory()->create([
            'commentable_id' => $project->id,
            'commentable_type' => Project::MORPH_SHORT_NAME, ]);
        $this->assertInstanceOf(Project::class, $comment->commentable);
        $this->assertEquals($comment->commentable->id, $project->id);
    }
}

<?php

namespace Tests\Unit\Models;

use App\Comment;
use App\EvaluationItem;
use App\EvaluationScore;
use App\Link;
use App\Portfolio;
use App\Project;
use App\ProjectOrderConstraint;
use App\ResourceAllocation;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function testPortfolio()
    {
        $portfolio = Portfolio::factory()->create();
        $project = Project::factory()->create(['portfolio_id' => $portfolio->id]);
        $this->assertInstanceOf(Portfolio::class, $project->portfolio);
        $this->assertEquals($project->portfolio->id, $portfolio->id);
    }

    public function testEvaluationScores()
    {
        $portfolio = Portfolio::factory()->create();
        $project = Project::factory()->create(['portfolio_id' => $portfolio->id]);
        $evaluationItem = EvaluationItem::factory()->create();
        EvaluationScore::factory()->create([
            'project_id' => $project->id,
            'evaluation_item_id' => $evaluationItem->id,
            ]);
        $this->assertEquals(1, $project->evaluationScores->count());
    }

    public function testResourceAllocations()
    {
        $project = Project::factory()->create();
        $allocation = ResourceAllocation::factory()->create(['project_id' => $project->id]);
        $this->assertEquals(1, $project->resourceAllocations->count());
    }

    public function testBeforeProjects()
    {
        $project = Project::factory()->create();
        $order = ProjectOrderConstraint::factory()->create(['before_project_id' => $project->id]);
        $this->assertEquals(1, $project->beforeProjects->count());
    }

    public function testAfterProjects()
    {
        $project = Project::factory()->create();
        $order = ProjectOrderConstraint::factory()->create(['after_project_id' => $project->id]);
        $this->assertEquals(1, $project->afterProjects->count());
    }

    public function testLinks()
    {
        $project = Project::factory()->create();
        $link = Link::factory()->create([
            'linkable_id' => $project->id,
            'linkable_type' => Project::MORPH_SHORT_NAME,
        ]);
        $this->assertEquals(1, $project->links->count());
    }

    public function testComments()
    {
        $project = Project::factory()->create();
        $link = Comment::factory()->create([
            'commentable_id' => $project->id,
            'commentable_type' => Project::MORPH_SHORT_NAME,
        ]);
        $this->assertEquals(1, $project->comments->count());
    }
}

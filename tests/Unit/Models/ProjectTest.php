<?php

namespace Tests\Unit\Models;

use App\EvaluationItem;
use App\EvaluationScore;
use App\PortfolioUnit;
use App\Project;
use App\ProjectOrderConstraint;
use App\ResourceAllocation;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function testPortfolio()
    {
        $portfolioUnit = PortfolioUnit::factory()->create();
        $project = Project::factory()->create(['portfolio_unit_id' => $portfolioUnit->id]);
        $this->assertInstanceOf(PortfolioUnit::class, $project->portfolio);
        $this->assertEquals($project->portfolio->id, $portfolioUnit->id);
    }

    public function testEvaluationScores()
    {
        $portfolioUnit = PortfolioUnit::factory()->create();
        $project = Project::factory()->create(['portfolio_unit_id' => $portfolioUnit->id]);
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
}

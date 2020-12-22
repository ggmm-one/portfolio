<?php

namespace Tests\Unit\Models;

use App\PortfolioUnit;
use App\Project;
use App\ProjectOrderConstraint;
use Tests\TestCase;

class ProjectOrderConstraintTest extends TestCase
{
    public function testBeforeProject()
    {
        $portfolio = PortfolioUnit::factory()->create();
        $before = Project::factory()->create([
            'portfolio_unit_id' => $portfolio->id,
        ]);
        $after = Project::factory()->create([
            'portfolio_unit_id' => $portfolio->id,
        ]);
        $constraint = ProjectOrderConstraint::factory()->create([
            'before_project_id' => $before->id,
            'after_project_id' => $after->id,
        ]);
        $this->assertInstanceOf(Project::class, $constraint->beforeProject);
        $this->assertEquals($constraint->beforeProject->id, $before->id);
    }

    public function testAfterProject()
    {
        $portfolio = PortfolioUnit::factory()->create();
        $before = Project::factory()->create([
            'portfolio_unit_id' => $portfolio->id,
        ]);
        $after = Project::factory()->create([
            'portfolio_unit_id' => $portfolio->id,
        ]);
        $constraint = ProjectOrderConstraint::factory()->create([
            'before_project_id' => $before->id,
            'after_project_id' => $after->id,
        ]);
        $this->assertInstanceOf(Project::class, $constraint->afterProject);
        $this->assertEquals($constraint->afterProject->id, $after->id);
    }
}

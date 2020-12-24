<?php

namespace Tests\Unit\Models;

use App\EvaluationItem;
use App\EvaluationScore;
use App\Project;
use Tests\TestCase;

class EvaluationScoreTest extends TestCase
{
    public function testEvaluationScores()
    {
        $project = Project::factory()->create();
        $score = EvaluationScore::factory()->create(['project_id' => $project->id]);
        $this->assertInstanceOf(Project::class, $score->project);
        $this->assertEquals($score->project->id, $project->id);
    }

    public function testEvaluationItem()
    {
        $evalItem = EvaluationItem::factory()->create();
        $score = EvaluationScore::factory()->create(['evaluation_item_id' => $evalItem->id]);
        $this->assertInstanceOf(EvaluationItem::class, $score->evaluationItem);
        $this->assertEquals($score->evaluationItem->id, $evalItem->id);
    }
}

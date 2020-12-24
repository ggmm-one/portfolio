<?php

namespace Tests\Unit\Models;

use App\EvaluationItem;
use App\EvaluationScore;
use Tests\TestCase;

class EvaluationItemTest extends TestCase
{
    public function testEvaluationScores()
    {
        $evalItem = EvaluationItem::factory()->create();
        $score = EvaluationScore::factory()->create(['evaluation_item_id' => $evalItem->id]);
        $this->assertEquals(1, $evalItem->evaluationScores->count());
    }
}

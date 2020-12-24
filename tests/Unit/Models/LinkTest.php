<?php

namespace Tests\Unit\Models;

use App\Link;
use App\Project;
use Tests\TestCase;

class LinkTest extends TestCase
{
    public function testLinkable()
    {
        $project = Project::factory()->create();
        $link = Link::factory()->create([
            'linkable_id' => $project->id,
            'linkable_type' => Project::MORPH_SHORT_NAME,
            'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_GOAL,
            ]);
        $this->assertInstanceOf(Project::class, $link->linkable);
        $this->assertEquals($link->linkable->id, $project->id);
    }
}

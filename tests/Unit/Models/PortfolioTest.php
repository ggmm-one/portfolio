<?php

namespace Tests\Unit\Models;

use App\Portfolio;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    public function testParent()
    {
        $parent = Portfolio::factory()->create();
        $portfolio = Portfolio::factory()->create(['parent_id' => $parent->id]);
        $this->assertInstanceOf(Portfolio::class, $portfolio->parent);
        $this->assertEquals($portfolio->parent->id, $parent->id);
    }

    public function testIsRoot()
    {
        $parent = Portfolio::factory()->create();
        $portfolio = Portfolio::factory()->create(['parent_id' => $parent->id]);
        $this->assertFalse($portfolio->isRoot());
        $this->assertTrue($parent->isRoot());
    }
}

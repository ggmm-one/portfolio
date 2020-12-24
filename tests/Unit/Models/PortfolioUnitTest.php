<?php

namespace Tests\Unit\Models;

use App\PortfolioUnit;
use Tests\TestCase;

class PortfolioUnitTest extends TestCase
{
    public function testParent()
    {
        $parent = PortfolioUnit::factory()->create();
        $portfolioUnit = PortfolioUnit::factory()->create(['parent_id' => $parent->id]);
        $this->assertInstanceOf(PortfolioUnit::class, $portfolioUnit->parent);
        $this->assertEquals($portfolioUnit->parent->id, $parent->id);
    }

    public function testIsRoot()
    {
        $parent = PortfolioUnit::factory()->create();
        $portfolioUnit = PortfolioUnit::factory()->create(['parent_id' => $parent->id]);
        $this->assertFalse($portfolioUnit->isRoot());
        $this->assertTrue($parent->isRoot());
    }
}

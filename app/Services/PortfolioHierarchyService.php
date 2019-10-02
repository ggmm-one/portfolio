<?php

namespace App\Services;

use App\PortfolioUnit;

class PortfolioHierarchyService
{
    public function process()
    {
        //Step 1: find and set root
        $root = PortfolioUnit::whereNull('parent_id')->first();
        $root->hierarchy_level = 0;
        $root->hierarchy_order = 0;
        $root->save();
        //Step 2: set remain non root recursively
        $portfolioUnits = PortfolioUnit::where('id', '<>', $root->id)->ordered()->get();
        self::addChildren($portfolioUnits, $root->id, 0, 0);
    }

    private function addChildren(&$portfolioUnits, $parentId, $parentLevel, $lastOrder)
    {
        $thisLevel = $parentLevel + 1;
        foreach ($portfolioUnits->where('parent_id', $parentId) as $key => $portfolioUnit) {
            $portfolioUnit->hierarchy_level = $thisLevel;
            $portfolioUnit->hierarchy_order = ++$lastOrder;
            $portfolioUnit->save();
            unset($portfolioUnits[$key]);
            $lastOrder = self::addChildren($portfolioUnits, $portfolioUnit->id, $thisLevel, $lastOrder);
        }
        return $lastOrder;
    }
}

<?php

namespace App\Services;

use App\Portfolio;

class PortfolioHierarchyService
{
    public function process()
    {
        //Step 1: find and set root
        $root = Portfolio::whereNull('parent_id')->first();
        $root->hierarchy_level = 0;
        $root->hierarchy_order = 0;
        $root->save();
        //Step 2: set remain non root recursively
        $portfolios = Portfolio::where('id', '<>', $root->id)->ordered()->get();
        self::addChildren($portfolios, $root->id, 0, 0);
    }

    private function addChildren(&$portfolios, $parentId, $parentLevel, $lastOrder)
    {
        $thisLevel = $parentLevel + 1;
        foreach ($portfolios->where('parent_id', $parentId) as $key => $portfolio) {
            $portfolio->hierarchy_level = $thisLevel;
            $portfolio->hierarchy_order = ++$lastOrder;
            $portfolio->save();
            unset($portfolios[$key]);
            $lastOrder = self::addChildren($portfolios, $portfolio->id, $thisLevel, $lastOrder);
        }

        return $lastOrder;
    }
}

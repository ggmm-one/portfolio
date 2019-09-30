<?php

namespace App\Http\Controllers\Portfolio;

use App\PortfolioUnit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Portfolio\PortfolioUnitRequest;

class PortfolioUnitController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', PortfolioUnit::class);
        $portfolioUnits = PortfolioUnit::hierarchyOrdered()->get();
        return view('portfolios.index', compact('portfolioUnits'));
    }

    public function create()
    {
        $this->authorize('create', PortfolioUnit::class);
        $portfolioUnit = new PortfolioUnit();
        $availParents = PortfolioUnit::getSelectList();
        $formAction = route('portfolios.portfolios.store', ['portfolio_unit' => $portfolioUnit->pid]);
        return view('portfolios.portfolios.edit', compact('portfolioUnit', 'availParents', 'formAction'));
    }

    public function store(PortfolioUnitRequest $request)
    {
        $this->authorize('create', PortfolioUnit::class);
        $portfolioUnit = PortfolioUnit::create($request->validated());
        PortfolioUnitController::processHierarchy();
        return Redirect::route('portfolios.portfolios.edit', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('view', $portfolioUnit);
        $availParents = PortfolioUnit::getSelectList($portfolioUnit);
        $formAction = route('portfolios.portfolios.update', ['portfolio_unit' => $portfolioUnit->pid]);
        return view('portfolios.portfolios.edit', compact('portfolioUnit', 'availParents', 'formAction'));
    }

    public function update(PortfolioUnitRequest $request, PortfolioUnit $portfolioUnit)
    {
        $this->authorize('update', $portfolioUnit);
        $validated = $request->validated();
        DB::transaction(function () use ($portfolioUnit, $validated) {
            $portfolioUnit->update($validated);
            static::processHierarchy();
        });
        return Redirect::route('portfolios.portfolios.edit', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('delete', $portfolioUnit);
        DB::transaction(function () use ($portfolioUnit) {
            $portfolioUnit->deleteIfNotReferenced();
            static::processHierarchy();
        });
        return Redirect::route('portfolios.portfolios.index');
    }

    public static function processHierarchy()
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

    private static function addChildren(&$portfolioUnits, $parentId, $parentLevel, $lastOrder)
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

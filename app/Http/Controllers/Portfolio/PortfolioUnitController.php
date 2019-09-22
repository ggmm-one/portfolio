<?php

namespace App\Http\Controllers\Portfolio;

use App\PortfolioUnit;
use App\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use TiMacDonald\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PortfolioUnitController extends Controller
{
    public function index()
    {
        $portfolioUnits = PortfolioUnit::orderBy('hierarchy_order')->get();
        return view('portfolios.index', compact('portfolioUnits'));
    }

    public function create()
    {
        $portfolioUnit = new PortfolioUnit();
        $availParents = PortfolioUnit::getSelectList();
        $formAction = route('portfolios.portfolios.store', ['portfolio_unit' => $portfolioUnit->pid]);
        return view('portfolios.portfolios.edit', compact('portfolioUnit', 'availParents', 'formAction'));
    }

    public function store(Request $request)
    {
        $portfolioUnit = PortfolioUnit::create($this->validateValues($request));
        PortfolioUnitController::processHierarchy();
        return Redirect::route('portfolios.portfolios.edit', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit)
    {
        $availParents = PortfolioUnit::getSelectList($portfolioUnit);
        $formAction = route('portfolios.portfolios.update', ['portfolio_unit' => $portfolioUnit->pid]);
        return view('portfolios.portfolios.edit', compact('portfolioUnit', 'availParents', 'formAction'));
    }

    public function update(Request $request, PortfolioUnit $portfolioUnit)
    {
        $validated = $this->validateValues($request, $portfolioUnit->isRoot());
        DB::transaction(function () use ($portfolioUnit, $validated) {
            $portfolioUnit->update($validated);
            static::processHierarchy();
        });
        return Redirect::route('portfolios.portfolios.edit', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit)
    {
        DB::transaction(function () use ($portfolioUnit) {
            $portfolioUnit->deleteIfNotReferenced();
            static::processHierarchy();
        });
        return Redirect::route('portfolios.portfolios.index');
    }

    private function validateValues(Request $request, $isRoot = false)
    {
        $validated = $request->validate([
            'name' => Rule::required()->string(1, PortfolioUnit::DD_NAME_LENGTH)->get(),
            'type' => Rule::when(!$isRoot, function ($rule) {
                $rule->required()
                        ->in(array_keys(PortfolioUnit::TYPES));
            })->get(),
            'parent_pid' => Rule::when(!$isRoot, function ($rule) {
                $rule->required()->exists('portfolio_units', 'pid');
            })->get(),
            'description' => Rule::max(PortfolioUnit::DD_DESCRIPTION_LENGTH)->get()
        ]);

        return $isRoot? Arr::only($validated, ['name', 'description']) : $validated;
    }

    public static function processHierarchy()
    {
        //Step 1: find and set root
        $query = PortfolioUnit::whereNull('parent_id');
        $root = $query->first();
        $root->hierarchy_level = 0;
        $root->hierarchy_order = 0;
        $root->save();
        //Step 2: set remain non root recursively
        $query = PortfolioUnit::where('id', '<>', $root->id)->orderBy('name');
        $portfolioUnits = $query->get();
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

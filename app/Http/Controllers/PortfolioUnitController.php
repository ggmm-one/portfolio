<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioUnitRequest;
use App\PortfolioUnit;
use App\Services\PortfolioHierarchyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PortfolioUnitController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', PortfolioUnit::class);

        $portfolioUnits = PortfolioUnit::hierarchyOrdered()->get();

        return view('portfolio_units.index', compact('portfolioUnits'));
    }

    public function create()
    {
        $this->authorize('create', PortfolioUnit::class);

        $portfolioUnit = new PortfolioUnit();

        return view('portfolio_units.edit', compact('portfolioUnit'));
    }

    public function store(PortfolioUnitRequest $request)
    {
        $this->authorize('create', PortfolioUnit::class);

        $portfolioUnit = PortfolioUnit::create($request->validated());
        self::processHierarchy();

        return back();
    }

    public function edit(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('update', $portfolioUnit);

        return view('portfolio_units.edit', compact('portfolioUnit'));
    }

    public function update(PortfolioUnitRequest $request, PortfolioUnit $portfolioUnit, PortfolioHierarchyService $portfolioHierarchyService)
    {
        $this->authorize('update', $portfolioUnit);

        $validated = $request->validated();
        DB::transaction(function () use ($portfolioUnit, $validated, $portfolioHierarchyService) {
            $portfolioUnit->update($validated);
            $portfolioHierarchyService->process();
        });

        return Redirect::route('portfolio_units.index');
    }

    public function destroy(PortfolioUnit $portfolioUnit, PortfolioHierarchyService $portfolioHierarchyService)
    {
        $this->authorize('delete', $portfolioUnit);
        DB::transaction(function () use ($portfolioUnit, $portfolioHierarchyService) {
            $portfolioUnit->deleteIfNotReferenced();
            $portfolioHierarchyService->processHierarchy();
        });

        return Redirect::route('portfolio_units.index');
    }
}

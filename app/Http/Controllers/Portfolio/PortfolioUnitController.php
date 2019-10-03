<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\PortfolioUnitRequest;
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
        self::processHierarchy();

        return Redirect::route('portfolios.portfolios.edit', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('view', $portfolioUnit);
        $availParents = PortfolioUnit::getSelectList($portfolioUnit);
        $formAction = route('portfolios.portfolios.update', ['portfolio_unit' => $portfolioUnit->pid]);

        return view('portfolios.portfolios.edit', compact('portfolioUnit', 'availParents', 'formAction'));
    }

    public function update(PortfolioUnitRequest $request, PortfolioUnit $portfolioUnit, PortfolioHierarchyService $portfolioHierarchyService)
    {
        $this->authorize('update', $portfolioUnit);
        $validated = $request->validated();
        DB::transaction(function () use ($portfolioUnit, $validated, $portfolioHierarchyService) {
            $portfolioUnit->update($validated);
            $portfolioHierarchyService->process();
        });

        return Redirect::route('portfolios.portfolios.edit', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit, PortfolioHierarchyService $portfolioHierarchyService)
    {
        $this->authorize('delete', $portfolioUnit);
        DB::transaction(function () use ($portfolioUnit, $portfolioHierarchyService) {
            $portfolioUnit->deleteIfNotReferenced();
            $portfolioHierarchyService->processHierarchy();
        });

        return Redirect::route('portfolios.portfolios.index');
    }
}

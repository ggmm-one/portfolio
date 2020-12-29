<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Portfolio;
use App\Services\PortfolioHierarchyService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PortfolioController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Portfolio::class);

        $portfolios = Portfolio::hierarchyOrdered()->get();

        return view('portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $this->authorize('create', Portfolio::class);

        $portfolio = new Portfolio();

        return view('portfolios.edit', compact('portfolio'));
    }

    public function store(PortfolioRequest $request)
    {
        $this->authorize('create', Portfolio::class);

        $portfolio = Portfolio::create($request->validated());
        self::processHierarchy();

        return Redirect::route('portfolios.index');
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);

        return view('portfolios.edit', compact('portfolio'));
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio, PortfolioHierarchyService $portfolioHierarchyService)
    {
        $this->authorize('update', $portfolio);

        $validated = $request->validated();
        DB::transaction(function () use ($portfolio, $validated, $portfolioHierarchyService) {
            $portfolio->update($validated);
            $portfolioHierarchyService->process();
        });

        return Redirect::route('portfolios.index');
    }

    public function destroy(Portfolio $portfolio, PortfolioHierarchyService $portfolioHierarchyService)
    {
        $this->authorize('delete', $portfolio);
        DB::transaction(function () use ($portfolio, $portfolioHierarchyService) {
            $portfolio->deleteIfNotReferenced();
            $portfolioHierarchyService->processHierarchy();
        });

        return Redirect::route('portfolios.index');
    }
}

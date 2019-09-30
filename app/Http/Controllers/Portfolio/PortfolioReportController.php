<?php

namespace App\Http\Controllers\Portfolio;

use App\PortfolioUnit;
use App\Http\Requests\LinkRequest;
use App\Link;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PortfolioReportController extends Controller
{
    public function index(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('view', $portfolioUnit);
        $links = $portfolioUnit->reports;
        $editRoute = route('portfolios.reports.edit', ['portfolio_unit' => $portfolioUnit->pid, 'link' => 'LLIINNKK']);
        return view('portfolios.reports.index', compact('portfolioUnit', 'links', 'editRoute'));
    }

    public function create(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('create', $portfolioUnit);
        $link = new Link;
        $formAction = route('portfolios.reports.store', ['portfolio_unit' => $portfolioUnit->pid]);
        $parentModel = $portfolioUnit;
        $deleteRoute = '';
        return view('links.edit', compact('link', 'formAction', 'parentModel', 'deleteRoute'));
    }

    public function store(LinkRequest $request, PortfolioUnit $portfolioUnit)
    {
        $this->authorize('view', $portfolioUnit);
        $link = new Link($request->validated());
        $link->linkable_subtype = Link::SUBTYPE_PORTFOLIO_REPORT;
        $portfolioUnit->links()->save($link);
        return Redirect::route('portfolios.reports.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->authorize('view', $portfolioUnit);
        $deleteRoute = route('portfolios.reports.destroy', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        $formAction = route('portfolios.reports.update', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        $parentModel = $portfolioUnit;
        return view('links.edit', compact('link', 'deleteRoute', 'formAction', 'parentModel'));
    }

    public function update(LinkRequest $request, PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->authorize('update', $portfolioUnit);
        $link->update($request->validated());
        return Redirect::route('portfolios.reports.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->authorize('delete', $portfolioUnit);
        $link->delete();
        return Redirect::route('portfolios.reports.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }
}

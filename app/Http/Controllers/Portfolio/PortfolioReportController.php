<?php

namespace App\Http\Controllers\Portfolio;

use App\PortfolioUnit;
use Illuminate\Http\Request;
use App\Link;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Redirect;

class PortfolioReportController extends LinkController
{
    public function index(PortfolioUnit $portfolioUnit)
    {
        $links = $portfolioUnit->reports;
        $editRoute = route('portfolios.reports.edit', ['portfolio_unit' => $portfolioUnit->pid, 'link' => 'LLIINNKK']);
        return view('portfolios.reports.index', compact('portfolioUnit', 'links', 'editRoute'));
    }

    public function create(PortfolioUnit $portfolioUnit)
    {
        $link = new Link;
        $formAction = route('portfolios.reports.store', ['portfolio_unit' => $portfolioUnit->pid]);
        return view('links.edit', compact('link', 'formAction'));
    }

    public function store(Request $request, PortfolioUnit $portfolioUnit)
    {
        $link = new Link($this->validateValues($request));
        $link->linkable_subtype = Link::SUBTYPE_PORTFOLIO_REPORT;
        $portfolioUnit->links()->save($link);
        return Redirect::route('portfolios.reports.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_REPORT);
        $deleteRoute = route('portfolios.reports.destroy', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        $formAction = route('portfolios.reports.update', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        return view('links.edit', compact('link', 'deleteRoute', 'formAction'));
    }

    public function update(Request $request, PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_REPORT);
        $link->update($this->validateValues($request));
        return Redirect::route('portfolios.reports.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_REPORT);
        $link->delete();
        return Redirect::route('portfolios.reports.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }
}

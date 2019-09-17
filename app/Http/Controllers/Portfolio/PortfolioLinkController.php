<?php

namespace App\Http\Controllers\Portfolio;

use App\PortfolioUnit;
use Illuminate\Http\Request;
use App\Link;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Redirect;

class PortfolioLinkController extends LinkController
{
    public function index(PortfolioUnit $portfolioUnit)
    {
        $links = $portfolioUnit->other_links;
        $editRoute = route('portfolios.links.edit', ['portfolio_unit' => $portfolioUnit->pid, 'link' => 'LLIINNKK']);
        return view('portfolios.links.index', compact('portfolioUnit', 'links', 'editRoute'));
    }

    public function create(PortfolioUnit $portfolioUnit)
    {
        $link = new Link;
        $formAction = route('portfolios.links.store', ['portfolio_unit' => $portfolioUnit->pid]);
        return view('links.edit', compact('link', 'formAction'));
    }

    public function store(Request $request, PortfolioUnit $portfolioUnit)
    {
        $validated = $this->validateValues($request);
        $link = new Link($validated);
        $link->linkable_subtype = Link::SUBTYPE_PORTFOLIO_OTHER;
        $portfolioUnit->links()->save($link);

        return Redirect::route('portfolios.links.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_OTHER);
        $deleteRoute = route('portfolios.links.destroy', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        $formAction = route('portfolios.links.update', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        return view('links.edit', compact('link', 'deleteRoute', 'formAction'));
    }

    public function update(Request $request, PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_OTHER);
        $validated = $this->validateValues($request);
        $link->update($validated);
        return Redirect::route('portfolios.links.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_OTHER);
        $link->delete();
        return Redirect::route('portfolios.links.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }
}

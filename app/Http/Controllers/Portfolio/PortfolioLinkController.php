<?php

namespace App\Http\Controllers\Portfolio;

use App\PortfolioUnit;
use App\Http\Requests\LinkRequest;
use App\Link;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PortfolioLinkController extends Controller
{
    public function index(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('view', $portfolioUnit);
        $links = $portfolioUnit->other_links;
        $editRoute = route('portfolios.links.edit', ['portfolio_unit' => $portfolioUnit->pid, 'link' => 'LLIINNKK']);
        return view('portfolios.links.index', compact('portfolioUnit', 'links', 'editRoute'));
    }

    public function create(PortfolioUnit $portfolioUnit)
    {
        $this->authorize('create', $portfolioUnit);
        $link = new Link;
        $formAction = route('portfolios.links.store', ['portfolio_unit' => $portfolioUnit->pid]);
        $parentModel = $portfolioUnit;
        $deleteRoute = '';
        return view('links.edit', compact('link', 'formAction', 'parentModel', 'deleteRoute'));
    }

    public function store(LinkRequest $request, PortfolioUnit $portfolioUnit)
    {
        $this->authorize('view', $portfolioUnit);
        $link = new Link($request->validated());
        $link->linkable_subtype = Link::SUBTYPE_PORTFOLIO_OTHER;
        $portfolioUnit->links()->save($link);
        return Redirect::route('portfolios.links.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->authorize('view', $portfolioUnit);
        $deleteRoute = route('portfolios.links.destroy', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        $formAction = route('portfolios.links.update', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        $parentModel = $portfolioUnit;
        return view('links.edit', compact('link', 'deleteRoute', 'formAction', 'parentModel'));
    }

    public function update(LinkRequest $request, PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->authorize('update', $portfolioUnit);
        $link->update($request->validated());
        return Redirect::route('portfolios.links.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->authorize('delete', $portfolioUnit);
        $link->delete();
        return Redirect::route('portfolios.links.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }
}

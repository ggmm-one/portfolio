<?php

namespace App\Http\Controllers\Portfolio;

use App\Link;
use App\PortfolioUnit;
use App\Http\Controllers\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PortfolioGoalController extends LinkController
{
    public function index(PortfolioUnit $portfolioUnit)
    {
        $links = $portfolioUnit->goals;
        $editRoute = route('portfolios.goals.edit', ['portfolio_unit' => $portfolioUnit->pid, 'link' => 'LLIINNKK']);
        return view('portfolios.goals.index', compact('portfolioUnit', 'links', 'editRoute'));
    }

    public function create(PortfolioUnit $portfolioUnit)
    {
        $link = new Link;
        $formAction = route('portfolios.goals.store', ['portfolio_unit' => $portfolioUnit->pid]);
        return view('links.edit', compact('link', 'formAction'));
    }

    public function store(Request $request,PortfolioUnit $portfolioUnit)
    {
        $link = new Link($this->validateValues($request));
        $link->linkable_subtype = Link::SUBTYPE_PORTFOLIO_GOAL;
        $portfolioUnit->links()->save($link);
        return Redirect::route('portfolios.goals.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_GOAL);
        $deleteRoute = route('portfolios.goals.destroy', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        $formAction = route('portfolios.goals.update', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        return view('links.edit', compact('link', 'deleteRoute', 'formAction'));
    }

    public function update(Request $request, PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_GOAL);
        $link->update($this->validateValues($request));
        return Redirect::route('portfolios.goals.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit, Link $link)
    {
        $this->validateModelLink($portfolioUnit, $link, Link::SUBTYPE_PORTFOLIO_GOAL);
        $link->delete();
        return Redirect::route('portfolios.goals.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

}

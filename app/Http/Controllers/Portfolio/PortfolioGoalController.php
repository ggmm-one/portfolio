<?php

namespace App\Http\Controllers\Portfolio;

use App\Link;
use App\PortfolioUnit;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use Illuminate\Support\Facades\Redirect;

class PortfolioGoalController extends Controller
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

    public function store(LinkRequest $request, PortfolioUnit $portfolioUnit)
    {
        $link = new Link($request->validated());
        $link->linkable_subtype = Link::SUBTYPE_PORTFOLIO_GOAL;
        $portfolioUnit->links()->save($link);
        return Redirect::route('portfolios.goals.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function edit(PortfolioUnit $portfolioUnit, Link $link)
    {
        $deleteRoute = route('portfolios.goals.destroy', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        $formAction = route('portfolios.goals.update', ['portfolio_unit' => $portfolioUnit->pid, 'link' => $link->pid]);
        return view('links.edit', compact('link', 'deleteRoute', 'formAction'));
    }

    public function update(LinkRequest $request, PortfolioUnit $portfolioUnit, Link $link)
    {
        $link->update($request->validated());
        return Redirect::route('portfolios.goals.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }

    public function destroy(PortfolioUnit $portfolioUnit, Link $link)
    {
        $link->delete();
        return Redirect::route('portfolios.goals.index', ['portfolio_unit' => $portfolioUnit->pid]);
    }
}

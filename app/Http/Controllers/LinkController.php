<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Link;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    public function index(LinkRequest $request)
    {
        $this->authorize('view', $request->holdingModel);

        $data = [
            'holdingModel' => $request->holdingModel,
            'project' => $request->holdingModel,
            'links' => $request->holdingModel->links()->subtype($request->routeSubtype)->get(),
        ];

        return view('links.index', $data);
    }

    public function create(LinkRequest $request)
    {
        $this->authorize('create', $request->holdingModel);

        return view('links.edit', ['holdingModel' => $request->holdingModel, 'link' => new Link()]);
    }

    public function store(LinkRequest $request)
    {
        $this->authorize('view', $request->holdingModel);

        $link = new Link($request->validated());
        $link->linkable_subtype = $request->routeSubtype;
        $request->holdingModel->links()->save($link);

        return Redirect::route(str_replace('store', 'index', $request->route()->getName()), $request->route()->parameters());
    }

    public function edit(LinkRequest $request)
    {
        $this->authorize('view', $request->holdingModel);

        $link = Link::findOrFail($request->holdingModel->decodeHashid($request->link));

        return view('links.edit', ['holdingModel' => $request->holdingModel, 'link' => $link]);
    }

    public function update(LinkRequest $request)
    {
        $this->authorize('update', $request->holdingModel);

        Link::findOrFail($request->holdingModel->decodeHashid($request->link))->update($request->validated());

        return Redirect::route(str_replace('update', 'index', $request->route()->getName()), $request->route()->parameters());
    }

    public function destroy(LinkRequest $request)
    {
        $this->authorize('delete', $request->holdingModel);

        Link::findOrFail($request->holdingModel->decodeHashid($request->link))->delete();

        return Redirect::route(str_replace('destroy', 'index', $request->route()->getName()), $request->route()->parameters());
    }
}

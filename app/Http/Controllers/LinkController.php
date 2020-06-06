<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Link;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('view', $holdingModel);
        $linkType = $this->getLinkType($request);
        $links = $holdingModel->{$linkType};
        $data = compact('holdingModel', 'links');
        $data[Str::camel(Str::singular($holdingModel->getTable()))] = $holdingModel;

        return view('links.index', $data);
    }

    public function create(Request $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('create', $holdingModel);
        $link = new Link;

        return view('links.edit', compact('holdingModel', 'link'));
    }

    public function store(LinkRequest $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('view', $holdingModel);
        $link = new Link($request->validated());
        $link->linkable_subtype = $this->getSubtype($request);
        $holdingModel->links()->save($link);

        return Redirect::route(str_replace('store', 'index', $request->route()->getName()), $request->route()->parameters());
    }

    public function edit(Request $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('view', $holdingModel);
        $link = Link::where('pid', $request->link)->firstOrFail();

        return view('links.edit', compact('holdingModel', 'link'));
    }

    public function update(LinkRequest $request)
    {
        $holdingModel = $this->getHoldingModel($request);
        $this->authorize('update', $holdingModel);
        Link::where('pid', $request->link)->firstOrFail()->update($request->validated());

        return Redirect::route(str_replace('update', 'index', $request->route()->getName()), $request->route()->parameters());
    }

    public function destroy(Project $project, Link $link)
    {
        $this->authorize('delete', $project);
        $link->delete();

        return Redirect::route('projects.links.index', ['project' => $project->pid]);
    }

    private function getHoldingModel(Request $request)
    {
        $model = null;
        $prefix = $request->route()->getName();

        if (Str::startsWith($prefix, 'projects')) {
            $model = Project::where('pid', $request->project)->firstOrFail();
        }

        return $model;
    }

    private function getLinkType(Request $request)
    {
        $name = $request->route()->getName();
        $types = ['links' => 'otherLinks', 'reports' => 'reports'];

        foreach ($types as $k => $v) {
            if (Str::contains($name, $k)) {
                return $v;
            }
        }
    }

    private function getSubtype(Request $request)
    {
        $name = $request->route()->getName();
        $subtypes = ['projects.links' => Link::SUBTYPE_PROJECT_OTHER, 'projects.reports' => Link::SUBTYPE_PROJECT_REPORT];

        foreach ($subtypes as $k => $v) {
            if (Str::startsWith($name, $k)) {
                return $v;
            }
        }
    }
}

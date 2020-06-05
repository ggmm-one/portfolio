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

    public function create(Project $project)
    {
        $holdingModel = $this->getHoldingModel();
        $this->authorize('create', $holdingModel);
        $link = new Link;

        return view('links.edit', compact('link'));
    }

    public function store(LinkRequest $request, Project $project)
    {
        $this->authorize('view', $project);
        $link = new Link($request->validated());
        $link->linkable_subtype = Link::SUBTYPE_PROJECT_OTHER;
        $project->links()->save($link);

        return Redirect::route('projects.links.index', ['project' => $project->pid]);
    }

    public function edit(Project $project, Link $link)
    {
        $this->authorize('view', $project);

        return view('links.edit', compact('link'));
    }

    public function update(LinkRequest $request, Project $project, Link $link)
    {
        $this->authorize('update', $project);
        $link->update($request->validated());

        return Redirect::route('projects.links.index', ['project' => $project->pid]);
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
        $prefix = $request->route()->getPrefix();

        if (Str::startsWith($prefix, '/projects')) {
            $model = Project::where('pid', $request->project)->firstOrFail();
        }

        return $model;
    }

    private function getLinkType(Request $request)
    {
        $name = $request->route()->getName();
        $possibleTypes = ['links', 'reports'];

        foreach ($possibleTypes as $possibleType) {
            if (Str::contains($name, $possibleType)) {
                return $possibleType;
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Link;
use App\Project;
use Illuminate\Support\Facades\Redirect;

class ProjectLinkController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('view', $project);
        $links = $project->other_links;

        return view('projects.links.index', compact('project', 'links'));
    }

    public function create(Project $project)
    {
        $this->authorize('create', $project);
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
}

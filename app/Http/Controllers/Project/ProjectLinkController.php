<?php

namespace App\Http\Controllers\Project;

use App\Project;
use App\Link;
use App\Http\Requests\LinkRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ProjectLinkController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('view', $project);
        $links = $project->other_links;
        $editRoute = route('projects.links.edit', ['project' => $project->pid, 'link' => 'LLIINNKK']);
        return view('projects.links.index', compact('project', 'links', 'editRoute'));
    }

    public function create(Project $project)
    {
        $this->authorize('create', $project);
        $link = new Link;
        $formAction = route('projects.links.store', ['project' => $project->pid]);
        $parentModel = $project;
        $deleteRoute = '';
        return view('links.edit', compact('link', 'formAction', 'parentModel', 'deleteRoute'));
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
        $deleteRoute = route('projects.links.destroy', ['project' => $project->pid, 'link' => $link->pid]);
        $formAction = route('projects.links.update', ['project' => $project->pid, 'link' => $link->pid]);
        $parentModel = $project;
        return view('links.edit', compact('link', 'deleteRoute', 'formAction', 'parentModel'));
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

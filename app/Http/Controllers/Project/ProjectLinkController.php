<?php

namespace App\Http\Controllers\Project;

use App\Project;
use App\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Redirect;

class ProjectLinkController extends LinkController
{
    public function index(Project $project)
    {
        $links = $project->other_links;
        $editRoute = route('projects.links.edit', ['project' => $project->pid, 'link' => 'LLIINNKK']);
        return view('projects.links.index', compact('project', 'links', 'editRoute'));
    }

    public function create(Project $project)
    {
        $link = new Link;
        $formAction = route('projects.links.store', ['project' => $project->pid]);
        return view('links.edit', compact('link', 'formAction'));
    }

    public function store(Request $request,Project $project)
    {
        $link = new Link($this->validateValues($request));
        $link->linkable_subtype = Link::SUBTYPE_PROJECT_OTHER;
        $project->links()->save($link);
        return Redirect::route('projects.links.index', ['project' => $project->pid]);
    }

    public function edit(Project $project, Link $link)
    {
        $this->validateModelLink($project, $link, Link::SUBTYPE_PROJECT_OTHER);
        if ($link->linkable_subtype != Link::SUBTYPE_PROJECT_OTHER) abort(404);
        $deleteRoute = route('projects.links.destroy', ['project' => $project->pid, 'link' => $link->pid]);
        $formAction = route('projects.links.update', ['project' => $project->pid, 'link' => $link->pid]);
        return view('links.edit', compact('link', 'deleteRoute', 'formAction'));
    }

    public function update(Request $request, Project $project, Link $link)
    {
        $this->validateModelLink($project, $link, Link::SUBTYPE_PROJECT_OTHER);
        $link->update($this->validateValues($request));
        return Redirect::route('projects.links.index', ['project' => $project->pid]);
    }

    public function destroy(Project $project, Link $link)
    {
        $this->validateModelLink($project, $link, Link::SUBTYPE_PROJECT_OTHER);
        $link->delete();
        return Redirect::route('projects.links.index', ['project' => $project->pid]);
    }
}

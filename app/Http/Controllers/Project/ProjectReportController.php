<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Link;
use App\Project;
use Illuminate\Support\Facades\Redirect;

class ProjectReportController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('view', $project);
        $links = $project->reports;
        $editRoute = route('projects.reports.edit', ['project' => $project->pid, 'link' => 'LLIINNKK']);

        return view('projects.reports.index', compact('project', 'links', 'editRoute'));
    }

    public function create(Project $project)
    {
        $this->authorize('create', $project);
        $link = new Link;
        $formAction = route('projects.reports.store', ['project' => $project->pid]);
        $parentModel = $project;
        $deleteRoute = '';

        return view('links.edit', compact('link', 'formAction', 'parentModel', 'deleteRoute'));
    }

    public function store(LinkRequest $request, Project $project)
    {
        $this->authorize('view', $project);
        $link = new Link($request->validated());
        $link->linkable_subtype = Link::SUBTYPE_PROJECT_REPORT;
        $project->links()->save($link);

        return Redirect::route('projects.reports.index', ['project' => $project->pid]);
    }

    public function edit(Project $project, Link $link)
    {
        $this->authorize('view', $project);
        $deleteRoute = route('projects.reports.destroy', ['project' => $project->pid, 'link' => $link->pid]);
        $formAction = route('projects.reports.update', ['project' => $project->pid, 'link' => $link->pid]);
        $parentModel = $project;

        return view('links.edit', compact('link', 'deleteRoute', 'formAction', 'parentModel'));
    }

    public function update(LinkRequest $request, Project $project, Link $link)
    {
        $this->authorize('update', $project);
        $link->update($request->validated());

        return Redirect::route('projects.reports.index', ['project' => $project->pid]);
    }

    public function destroy(Project $project, Link $link)
    {
        $this->authorize('delete', $project);
        $link->delete();

        return Redirect::route('projects.reports.index', ['project' => $project->pid]);
    }
}

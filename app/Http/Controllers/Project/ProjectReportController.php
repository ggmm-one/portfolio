<?php

namespace App\Http\Controllers\Project;

use App\Project;
use App\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Redirect;

class ProjectReportController extends LinkController
{
    public function index(Project $project)
    {
        $links = $project->reports;
        $editRoute = route('projects.reports.edit', ['project' => $project->pid, 'link' => 'LLIINNKK']);
        return view('projects.reports.index', compact('project', 'links', 'editRoute'));
    }

    public function create(Project $project)
    {
        $link = new Link;
        $formAction = route('projects.reports.store', ['project' => $project->pid]);
        return view('links.edit', compact('link', 'formAction'));
    }

    public function store(Request $request, Project $project)
    {
        $link = new Link($this->validateValues($request));
        $link->linkable_subtype = Link::SUBTYPE_PROJECT_REPORT;
        $project->links()->save($link);

        return Redirect::route('projects.reports.index', ['project' => $project->pid]);
    }

    public function edit(Request $request, Project $project, Link $link)
    {
        $this->validateModelLink($project, $link, Link::SUBTYPE_PROJECT_REPORT);
        $deleteRoute = route('projects.reports.destroy', ['project' => $project->pid, 'link' => $link->pid]);
        $formAction = route('projects.reports.update', ['project' => $project->pid, 'link' => $link->pid]);
        return view('links.edit', compact('link', 'deleteRoute', 'formAction'));
    }

    public function update(Request $request, Project $project, Link $link)
    {
        $this->validateModelLink($project, $link, Link::SUBTYPE_PROJECT_REPORT);
        $validated = $this->validateValues($request);
        $link->update($validated);
        return Redirect::route('projects.reports.index', ['project' => $project->pid]);
    }

    public function destroy(Project $project, Link $link)
    {
        $this->validateModelLink($project, $link, Link::SUBTYPE_PROJECT_REPORT);
        $link->delete();
        return Redirect::route('projects.reports.index', ['project' => $project->pid]);
    }


}

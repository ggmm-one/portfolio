<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Project::class);

        $projects = Project::ordered()->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $this->authorize('create', Project::class);

        $project = new Project;

        return view('projects.edit', compact('project'));
    }

    public function store(ProjectRequest $request)
    {
        $this->authorize('create', Project::class);

        Project::create($request->validated());

        return Redirect::route('projects.index');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validated());

        return Redirect::route('projects.index');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        DB::transaction(function () use ($project) {
            $project->delete();
        });

        return Redirect::route('projects.index');
    }
}

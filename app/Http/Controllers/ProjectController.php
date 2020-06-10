<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\PortfolioUnit;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Project::class);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $this->authorize('create', Project::class);
        $project = new Project;
        $formAction = route('projects.store');
        $portfolios = PortfolioUnit::getSelectList();

        return view('projects.edit', compact('project', 'formAction', 'portfolios'));
    }

    public function store(ProjectRequest $request)
    {
        $this->authorize('create', Project::class);
        $project = Project::create($request->validated());

        return Redirect::route('projects.edit', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('view', $project);
        $portfolios = PortfolioUnit::getSelectList();
        $formAction = route('projects.update', compact('project'));

        return view('projects.edit', compact('project', 'formAction', 'portfolios'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->validated());

        return Redirect::route('projects.edit', compact('project'));
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

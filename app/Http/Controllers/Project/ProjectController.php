<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
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
        $projects = $this->filter($request)->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $this->authorize('create', Project::class);
        $project = new Project;
        $formAction = route('projects.projects.store');
        $portfolios = PortfolioUnit::getSelectList();

        return view('projects.info.edit', compact('project', 'formAction', 'portfolios'));
    }

    public function store(ProjectRequest $request)
    {
        $this->authorize('create', Project::class);
        $project = Project::create($request->validated());

        return Redirect::route('projects.projects.edit', ['project' => $project->pid]);
    }

    public function edit(Project $project)
    {
        $this->authorize('view', $project);
        $portfolios = PortfolioUnit::getSelectList();
        $formAction = route('projects.projects.update', ['project' => $project->pid]);

        return view('projects.info.edit', compact('project', 'formAction', 'portfolios'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->validated());
        $portfolios = PortfolioUnit::getSelectList();
        $formAction = route('projects.projects.update', ['project' => $project->pid]);

        return view('projects.info.edit', compact('project', 'formAction', 'portfolios'));
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        DB::transaction(function () use ($project) {
            $project->delete();
        });

        return Redirect::route('projects.projects.index');
    }

    private function filter(Request &$request)
    {
        $builder = Project::with('portfolio:id,pid,name')->ordered();

        if ($request->has('portfolio_unit')) {
            $builder->join('portfolio_units', 'portfolio_units.id', '=', 'projects.portfolio_unit_id')
                ->where('portfolio_units.pid', $request->input('portfolio_unit'));
            $request->setFiltered();
        }

        return $builder;
    }
}

<?php

namespace App\Http\Controllers\Project;

use App\ProjectOrderConstraint;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectConstraintRequest;
use Illuminate\Support\Facades\Redirect;
use App\Project;

class ProjectConstraintController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('view', $project);
        $beforeProjects = $project->beforeProjects;
        $afterProjects = $project->afterProjects;
        $selectProjects = $project->getConstraintProjectsSelect();
        return view('projects.constraints.edit', compact('project', 'beforeProjects', 'afterProjects', 'selectProjects'));
    }

    public function store(ProjectConstraintRequest $request, Project $project)
    {
        $this->authorize('create', ProjectOrderConstraint::class);
        $projectOrderConstraint = new projectOrderConstraint();
        $projectOrderConstraint->before_project_id = $project->id;
        $projectOrderConstraint->after_project_id = Project::getId($request->validated()['pid']);
        $projectOrderConstraint->save();
        return Redirect::route('projects.constraints.index', compact('project'));
    }

    public function update(ProjectConstraintRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->validated());
        return Redirect::route('projects.constraints.index', compact('project'));
    }

    public function destroy(Project $project, ProjectOrderConstraint $projectOrderConstraint)
    {
        abort_if($project->id != $projectOrderConstraint->before_project_id, 400);
        $this->authorize('delete', $projectOrderConstraint);
        $projectOrderConstraint->delete();
        return Redirect::route('projects.constraints.index', compact('project'));
    }
}

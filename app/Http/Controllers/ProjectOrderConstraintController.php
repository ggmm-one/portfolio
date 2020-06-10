<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectConstraintRequest;
use App\Project;
use App\ProjectOrderConstraint;
use Illuminate\Support\Facades\Redirect;

class ProjectOrderConstraintController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('view', $project);
        $beforeProjects = $project->beforeProjects;
        $afterProjects = $project->afterProjects;
        $selectProjects = $project->getConstraintProjectsSelect();

        return view('project_order_constraints.edit', compact('project', 'beforeProjects', 'afterProjects', 'selectProjects'));
    }

    public function store(ProjectConstraintRequest $request, Project $project)
    {
        $this->authorize('create', ProjectOrderConstraint::class);
        $projectOrderConstraint = new projectOrderConstraint();
        $projectOrderConstraint->before_project_id = $project->id;
        $projectOrderConstraint->after_project_id = $project->hashidToId($request->validated()['hashid']);
        $projectOrderConstraint->save();

        return Redirect::route('project_order_constraints.index', compact('project'));
    }

    public function update(ProjectConstraintRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->validated());

        return Redirect::route('project_order_constraints.index', compact('project'));
    }

    public function destroy(Project $project, ProjectOrderConstraint $projectOrderConstraint)
    {
        abort_if($project->id != $projectOrderConstraint->before_project_id, 400);
        $this->authorize('delete', $projectOrderConstraint);
        $projectOrderConstraint->delete();

        return Redirect::route('project_order_constraints.index', compact('project'));
    }
}

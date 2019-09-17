<?php

namespace App\Http\Controllers\Project;

use App\ProjectOrderConstraint;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use TiMacDonald\Validation\Rule;

class ProjectConstraintController extends Controller
{
    public function index(Project $project)
    {
        $beforeProjects = $project->beforeProjects;
        $afterProjects = $project->afterProjects;
        $selectProjects = $project->getConstraintProjectsSelect();
        return view('projects.constraints.edit', compact('project', 'beforeProjects', 'afterProjects', 'selectProjects'));
    }

    public function store(Request $request, Project $project)
    {
        $project_pid = $request->validate([
            'pid' => Rule::required()->exists('projects')->get()
        ]);
        $projectOrderConstraint = new projectOrderConstraint();
        $projectOrderConstraint->before_project_id = $project->id;
        $projectOrderConstraint->after_project_id = Project::getId($project_pid);
        $projectOrderConstraint->save();
        return Redirect::route('projects.constraints.index', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $values = $request->validate([
            'start_after' => Rule::nullable()->date()->get(),
            'end_before' => Rule::nullable()->date()->get()
        ]);
        $project->update($values);
        return Redirect::route('projects.constraints.index', compact('project'));
    }

    public function destroy(Project $project, ProjectOrderConstraint $projectOrderConstraint)
    {
        if ($project->id != $projectOrderConstraint->before_project_id) abort(400);
        $projectOrderConstraint->delete();
        return Redirect::route('projects.constraints.index', compact('project'));
    }
}

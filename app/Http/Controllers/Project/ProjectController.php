<?php

namespace App\Http\Controllers\Project;

use App\Project;
use App\PortfolioUnit;
use App\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use TiMacDonald\Validation\Rule;
use App\Libraries\DateHelper;
use App\Scopes\OrganizationScope;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = $this->filter($request)->get();
        return view('projects.projects.index', compact('projects'));
    }

    public function create()
    {
        $project = new Project;
        $formAction = route('projects.projects.store');
        $portfolios = PortfolioUnit::getSelectList();
        return view('projects.projects.edit', compact('project', 'formAction', 'portfolios'));
    }

    public function store(Request $request)
    {
        $project = Project::create($this->validateValues($request));
        return Redirect::route('projects.projects.edit', ['project' => $project->pid]);
    }

    public function edit(Project $project)
    {
        $portfolios = PortfolioUnit::getSelectList();
        $formAction = route('projects.projects.update', ['project' => $project->pid]);
        return view('projects.projects.edit', compact('project', 'formAction', 'portfolios'));
    }

    public function update(Request $request, Project $project)
    {
        $project->update($this->validateValues($request));
        $portfolios = PortfolioUnit::getSelectList();
        $formAction = route('projects.projects.update', ['project' => $project->pid]);
        return view('projects.projects.edit', compact('project', 'formAction', 'portfolios'));
    }

    public function destroy(Project $project)
    {
        DB::transaction(function () use ($project) {
            $project->delete();
        });
        return Redirect::route('projects.projects.index');
    }

    private function validateValues(Request $request)
    {
        $values = $request->validate([
            'name' => Rule::required()->string(1, Project::DD_NAME_LENGTH)->get(),
            'code' => Rule::nullable()->string(1, Project::DD_CODE_LENGTH)->get(),
            'portfolio_unit_pid' => Rule::required()->get(),
            'type' => Rule::required()->in(array_keys(Project::TYPES))->get(),
            'status' => Rule::required()->in(array_keys(Project::STATUS))->get(),
            'start' => Rule::nullable()->after(Model::DD_DATE_MIN)->before(Model::DD_DATE_MAX)->get(),
            'duration' => Rule::nullable()->integer()->min(1)->max(Project::DD_DURATION_MAX)->get(),
            'description' => Rule::nullable()->string(1, Project::DD_DESCRIPTION_LENGTH)->get()
        ]);
        $values['start'] = DateHelper::setDateToMonth($values['start']);
        return $values;
    }

    private function filter(Request &$request)
    {
        $builder = Project::with('portfolio:id,pid,name');

        if ($request->has('portfolio_unit')) {
            $builder->join('portfolio_units', 'portfolio_units.id', '=', 'projects.portfolio_unit_id')
                ->where('portfolio_units.pid', $request->input('portfolio_unit'));
            $request->setFiltered();
        }

        $builder->orderBy('name');

        return $builder;
    }

    public static function updateProjectScore($id = null, $withoutOrganizationScope = false)
    {
        $query = Project::orderBy('id');
        if ($withoutOrganizationScope) {
            $query->withoutGlobalScope(OrganizationScope::class);
        }
        if ($id) {
            $query->where('id', $id);
        }
        $query->update(['score' => DB::raw('(select sum(weighted_score) from evaluation_scores where evaluation_scores.project_id = projects.id)')]);
    }
}

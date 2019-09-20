<?php

namespace App\Http\Controllers\Project;

use App\EvaluationScore;
use App\Project;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use TiMacDonald\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EvaluationScoreController extends Controller
{
    public function index(Project $project)
    {
        $evaluationScores = $project->evaluationScores()->with('evaluationItem')->get()->sortBy(function ($score) {
            return $score->evaluationItem->sort_order;
        });
        return view('projects.evaluations.index', compact('project', 'evaluationScores'));
    }

    public function edit(Project $project, EvaluationScore $evaluationScore)
    {
        if ($project->id != $evaluationScore->project_id) {
            abort(400);
        }
        $setting = Setting::first();
        $evaluationScore->load('evaluationItem');
        return view('projects.evaluations.edit', compact('project', 'evaluationScore', 'setting'));
    }

    public function update(Request $request, Project $project, EvaluationScore $evaluationScore)
    {
        if ($project->id != $evaluationScore->project_id) {
            abort(400);
        }
        $values = $this->validateValues($request);
        DB::transaction(function () use ($project, $evaluationScore, $values) {
            $evaluationScore->update($values);
            self::updateWeightedScore($evaluationScore->id);
            ProjectController::updateProjectScore($project->id);
        });
        return Redirect::route('projects.evaluations.index', compact('project'));
    }

    public function validateValues(Request $request)
    {
        $evaluationMax = Setting::first()->value('evaluation_max');

        return $request->validate([
            'score' => Rule::required()->integer(1, $evaluationMax)->get(),
            'description' => Rule::required()->string(1, EvaluationScore::DD_DESCRIPTION_LENGTH)->get()
        ]);
    }

    public static function updateWeightedScore($id = null)
    {
        $query = EvaluationScore::orderBy('id');
        if ($id) {
            $query->where('id', $id);
        }
        $query->update(['weighted_score' => DB::raw('score * (select weight_factor from evaluation_items where evaluation_scores.evaluation_item_id = evaluation_items.id and evaluation_items.deleted_at is null)')]);
    }
}

<?php

namespace App\Http\Controllers\Project;

use App\EvaluationScore;
use App\Project;
use App\Setting;
use App\Http\Requests\EvaluationScoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class EvaluationScoreController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('viewAny', $project);
        $evaluationScores = $project->evaluationScores()->with('evaluationItem')->get()->sortBy(function ($score) {
            return $score->evaluationItem->sort_order;
        });
        return view('projects.evaluations.index', compact('project', 'evaluationScores'));
    }

    public function edit(EvaluationScoreRequest $request, Project $project, EvaluationScore $evaluationScore)
    {
        $this->authorize('view', $project);
        $setting = Setting::first();
        $evaluationScore->load('evaluationItem');
        return view('projects.evaluations.edit', compact('project', 'evaluationScore', 'setting'));
    }

    public function update(EvaluationScoreRequest $request, Project $project, EvaluationScore $evaluationScore)
    {
        $this->authorize('update', $project);
        DB::transaction(function () use ($request, $project, $evaluationScore) {
            $evaluationScore->update($request->validated());
            self::updateWeightedScore($evaluationScore->id);
            ProjectController::updateProjectScore($project->id);
        });
        return Redirect::route('projects.evaluations.index', compact('project'));
    }

    public static function updateWeightedScore($id = null)
    {
        $query = EvaluationScore::query();
        if ($id) {
            $query->where('id', $id);
        }
        $query->update(['weighted_score' => DB::raw('score * (select weight_factor from evaluation_items where evaluation_scores.evaluation_item_id = evaluation_items.id and evaluation_items.deleted_at is null)')]);
    }
}

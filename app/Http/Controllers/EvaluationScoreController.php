<?php

namespace App\Http\Controllers;

use App\EvaluationScore;
use App\Http\Requests\EvaluationScoreRequest;
use App\Project;
use App\Services\ProjectScoringService;
use App\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EvaluationScoreController extends Controller
{
    public function index(Project $project)
    {
        $this->authorize('viewAny', $project);
        $evaluationScores = $project->evaluationScores()->with('evaluationItem')->get()->sortBy(function ($score) {
            return $score->evaluationItem->sort_order;
        });

        return view('evaluation_scores.index', compact('project', 'evaluationScores'));
    }

    public function edit(EvaluationScoreRequest $request, Project $project, EvaluationScore $evaluationScore)
    {
        $this->authorize('view', $project);
        $setting = Setting::first();
        $evaluationScore->load('evaluationItem');

        return view('evaluation_scores.edit', compact('project', 'evaluationScore', 'setting'));
    }

    public function update(EvaluationScoreRequest $request, Project $project, EvaluationScore $evaluationScore, ProjectScoringService $projectScoringService)
    {
        $this->authorize('update', $project);
        DB::transaction(function () use ($request, $project, $evaluationScore, $projectScoringService) {
            $evaluationScore->update($request->validated());
            $projectScoringService->updateWeightedScore($evaluationScore->id);
            $projectScoringService->updateProjectScore($project->id);
        });

        return Redirect::route('evaluation_scores.index', compact('project'));
    }
}

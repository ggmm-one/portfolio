<?php

namespace App\Http\Controllers\Admin;

use App\EvaluationItem;
use App\EvaluationScore;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EvaluationItemRequest;
use App\Project;
use App\Services\ProjectScoringService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EvaluationItemController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', EvaluationItem::class);
        $evaluationItems = EvaluationItem::sorted()->get();
        $sum = array_sum(Arr::pluck($evaluationItems, 'weight'));

        return view('admin.evaluation_items.index', compact('evaluationItems', 'sum'));
    }

    public function create()
    {
        $this->authorize('create', EvaluationItem::class);
        $evaluationItem = new EvaluationItem();
        $formAction = route('admin.evaluation_items.store');

        return view('admin.evaluation_items.edit', compact('evaluationItem', 'formAction'));
    }

    public function store(EvaluationItemRequest $request, ProjectScoringService $projectScoringService)
    {
        $this->authorize('create', EvaluationItem::class);
        DB::transaction(function () use ($request, $projectScoringService) {
            $evaluationItem = EvaluationItem::create($request->validated());
            foreach (Project::all() as $project) {
                $evaluationScore = new EvaluationScore([
                    'score' => 1,
                    'description' => 'Automatic Initial Assigned Score',
                ]);
                $evaluationScore->project_id = $project->id;
                $evaluationScore->evaluation_item_id = $evaluationItem->id;
                $evaluationScore->save();
            }
            $projectScoringService->recalculateAll();
        });

        return Redirect::route('admin.evaluation_items.index');
    }

    public function edit(EvaluationItem $evaluationItem)
    {
        $this->authorize('view', $evaluationItem);
        $formAction = route('admin.evaluation_items.update', ['evaluation_item' => $evaluationItem->pid]);

        return view('admin.evaluation_items.edit', compact('evaluationItem', 'formAction'));
    }

    public function update(EvaluationItemRequest $request, EvaluationItem $evaluationItem, ProjectScoringService $projectScoringService)
    {
        $this->authorize('update', $evaluationItem);
        DB::transaction(function () use ($evaluationItem, $request, $projectScoringService) {
            $evaluationItem->update($request->validated());
            $projectScoringService->recalculateAll();
        });

        return Redirect::route('admin.evaluation_items.index');
    }

    public function destroy(EvaluationItem $evaluationItem, ProjectScoringService $projectScoringService)
    {
        $this->authorize('delete', $evaluationItem);
        DB::transaction(function () use ($evaluationItem, $projectScoringService) {
            $evaluationItem->delete();
            $projectScoringService->recalculateAll();
        });

        return Redirect::route('admin.evaluation_items.index');
    }
}

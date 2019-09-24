<?php

namespace App\Http\Controllers\Admin;

use App\EvaluationItem;
use App\EvaluationScore;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Project\EvaluationScoreController;
use App\Http\Controllers\Project\ProjectController;
use App\Project;
use App\Http\Requests\Admin\EvaluationItemRequest;

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

    public function store(EvaluationItemRequest $request)
    {
        $this->authorize('create', EvaluationItem::class);
        DB::transaction(function () use ($request) {
            $evaluationItem = EvaluationItem::create($request->validated());
            foreach (Project::all() as $project) {
                $evaluationScore = new EvaluationScore([
                    'score' => 1,
                    'description' => 'Automatic Initial Assigned Score'
                ]);
                $evaluationScore->project_id = $project->id;
                $evaluationScore->evaluation_item_id = $evaluationItem->id;
                $evaluationScore->save();
            }
            $this->recalculate();
        });
        return Redirect::route('admin.evaluation_items.index');
    }

    public function edit(EvaluationItem $evaluationItem)
    {
        $this->authorize('view', $evaluationItem);
        $formAction = route('admin.evaluation_items.update', ['evaluation_item' => $evaluationItem->pid]);
        return view('admin.evaluation_items.edit', compact('evaluationItem', 'formAction'));
    }

    public function update(EvaluationItemRequest $request, EvaluationItem $evaluationItem)
    {
        $this->authorize('update', $evaluationItem);
        DB::transaction(function () use ($evaluationItem, $request) {
            $evaluationItem->update($request->validated());
            $this->recalculate();
        });

        return Redirect::route('admin.evaluation_items.index');
    }

    public function destroy(EvaluationItem $evaluationItem)
    {
        $this->authorize('delete', $evaluationItem);
        DB::transaction(function () use ($evaluationItem) {
            $evaluationItem->delete();
            $this->recalculate();
        });
        return Redirect::route('admin.evaluation_items.index');
    }

    private function recalculate()
    {
        self::updateWeightFactor();
        EvaluationScoreController::updateWeightedScore();
        ProjectController::updateProjectScore();
    }

    public static function updateWeightFactor()
    {
        EvaluationItem::query()->update(['weight_factor' => DB::raw("(cast(weight as real) / (select sum(ei.weight) from evaluation_items ei))")]);
        EvaluationItem::query()->update(['weight_factor' => DB::raw("(cast(weight_factor as real) / (select evaluation_max from settings))")]);
    }
}

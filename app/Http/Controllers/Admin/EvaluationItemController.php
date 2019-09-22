<?php

namespace App\Http\Controllers\Admin;

use App\EvaluationItem;
use App\EvaluationScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TiMacDonald\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Project\EvaluationScoreController;
use App\Http\Controllers\Project\ProjectController;
use App\Project;

class EvaluationItemController extends Controller
{
    public function index()
    {
        $evaluationItems = EvaluationItem::sorted()->get();
        $sum = array_sum(Arr::pluck($evaluationItems, 'weight'));
        return view('admin.evaluation_items.index', compact('evaluationItems', 'sum'));
    }

    public function create()
    {
        $evaluationItem = new EvaluationItem();
        $formAction = route('admin.evaluation_items.store');
        return view('admin.evaluation_items.edit', compact('evaluationItem', 'formAction'));
    }

    public function store(Request $request)
    {
        $values = $this->validateValues($request);

        DB::transaction(function () use ($values) {
            $evaluationItem = EvaluationItem::create($values);
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
        $formAction = route('admin.evaluation_items.update', ['evaluation_item' => $evaluationItem->pid]);
        return view('admin.evaluation_items.edit', compact('evaluationItem', 'formAction'));
    }

    public function update(Request $request, EvaluationItem $evaluationItem)
    {
        $values = $this->validateValues($request);

        DB::transaction(function () use ($evaluationItem, $values) {
            $evaluationItem->update($values);
            $this->recalculate();
        });

        return Redirect::route('admin.evaluation_items.index');
    }

    public function destroy(EvaluationItem $evaluationItem)
    {
        DB::transaction(function () use ($evaluationItem) {
            $evaluationItem->delete();
            $this->recalculate();
        });
        return Redirect::route('admin.evaluation_items.index');
    }

    private function validateValues(Request $request)
    {
        return $request->validate([
            'name' => Rule::required()->string(1, EvaluationItem::DD_NAME_LENGTH)->get(),
            'instructions' => Rule::nullable()->string(1, EvaluationItem::DD_INSTRUCTIONS_LENGTH)->get(),
            'weight' => Rule::required()->integer(1, EvaluationItem::DD_WEIGHT_MAX)->get(),
            'sort_order' => Rule::required()->integer(0, EvaluationItem::DD_SORT_ORDER_MAX)->get()
        ]);
    }

    private function recalculate()
    {
        self::updateWeightFactor();
        EvaluationScoreController::updateWeightedScore();
        ProjectController::updateProjectScore();
    }

    public static function updateWeightFactor()
    {
        EvaluationItem::query()->update(['weight_factor' => DB::raw("(cast(weight as real) /	(select sum(ei.weight) from evaluation_items ei))")]);
        EvaluationItem::query()->update(['weight_factor' => DB::raw("(cast(weight_factor as real) / (select evaluation_max from settings))")]);
    }
}

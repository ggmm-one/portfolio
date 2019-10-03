<?php

namespace App\Services;

use App\EvaluationItem;
use App\EvaluationScore;
use App\Project;
use Illuminate\Support\Facades\DB;

class ProjectScoringService
{
    public function recalculateAll()
    {
        $this->updateWeightFactor();
        $this->updateWeightedScore();
        $this->updateProjectScore();
    }

    public function updateWeightFactor()
    {
        EvaluationItem::query()->update(['weight_factor' => DB::raw('(cast(weight as real) / (select sum(ei.weight) from evaluation_items ei))')]);
        EvaluationItem::query()->update(['weight_factor' => DB::raw('(cast(weight_factor as real) / (select evaluation_max from settings))')]);
    }

    public function updateWeightedScore($id = null)
    {
        $query = EvaluationScore::query();
        if ($id) {
            $query->where('id', $id);
        }
        $query->update(['weighted_score' => DB::raw('score * (select weight_factor from evaluation_items where evaluation_scores.evaluation_item_id = evaluation_items.id and evaluation_items.deleted_at is null)')]);
    }

    public function updateProjectScore($id = null)
    {
        $query = Project::query();
        if ($id) {
            $query->where('id', $id);
        }
        $query->update(['score' => DB::raw('(select sum(weighted_score) from evaluation_scores where evaluation_scores.project_id = projects.id)')]);
    }
}

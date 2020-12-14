<?php

namespace Database\Seeders;

use App\EvaluationItem;
use App\EvaluationScore;
use App\Project;
use App\Services\ProjectScoringService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationScoresTableSeeder extends Seeder
{
    public function run()
    {
        foreach (Project::select('id')->orderBy('id')->get() as $project) {
            foreach (EvaluationItem::select('id')->orderBy('id')->get() as $item) {
                EvaluationScore::factory()->create([
                    'project_id' => $project->id,
                    'evaluation_item_id' => $item->id,
                ]);
            }
        }
        DB::statement('update evaluation_scores set score = (select evaluation_max from settings) where score > (select evaluation_max from settings)');
        $scoring = new ProjectScoringService;
        $scoring->updateWeightedScore(null);
        $scoring->updateProjectScore(null);
    }
}

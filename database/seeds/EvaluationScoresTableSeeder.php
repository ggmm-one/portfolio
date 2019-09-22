<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\EvaluationItem;
use App\EvaluationScore;
use App\Http\Controllers\Project\EvaluationScoreController;
use App\Http\Controllers\Project\ProjectController;

class EvaluationScoresTableSeeder extends Seeder
{
    public function run()
    {
        foreach (Project::select('id')->orderBy('id')->get() as $project) {
            foreach (EvaluationItem::select('id')->orderBy('id')->get() as $item) {
                factory(EvaluationScore::class)->create([
                    'project_id' => $project->id,
                    'evaluation_item_id' => $item->id
                ]);
            }
        }
        DB::statement('update evaluation_scores set score = (select evaluation_max from settings) where score > (select evaluation_max from settings)');
        EvaluationScoreController::updateWeightedScore(null, true);
        ProjectController::updateProjectScore(null, true);
    }
}

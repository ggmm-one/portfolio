<?php

use Illuminate\Database\Seeder;
use App\Organization;
use App\Project;
use App\EvaluationItem;
use App\EvaluationScore;
use App\Http\Controllers\Project\EvaluationScoreController;
use App\Http\Controllers\Project\ProjectController;

class EvaluationScoresTableSeeder extends Seeder
{
    public function run()
    {
        foreach (Organization::withoutGlobalScopes()->select('id')->orderBy('id')->get() as $organization) {
            foreach (Project::withoutGlobalScopes()->select('id')->where('organization_id', $organization->id)->orderBy('id')->get() as $project) {
                foreach (EvaluationItem::withoutGlobalScopes()->select('id')->orderBy('id')->where('organization_id', $organization->id)->get() as $item) {
                    factory(EvaluationScore::class)->create([
                        'organization_id' => $organization->id,
                        'project_id' => $project->id,
                        'evaluation_item_id' => $item->id
                    ]);
                }
            }
        }
        DB::statement('update evaluation_scores set score = (select evaluation_max from settings where settings.organization_id = evaluation_scores.organization_id) where score > (select evaluation_max from settings where settings.organization_id = evaluation_scores.organization_id)');
        EvaluationScoreController::updateWeightedScore(null, true);
        ProjectController::updateProjectScore(null, true);
    }
}

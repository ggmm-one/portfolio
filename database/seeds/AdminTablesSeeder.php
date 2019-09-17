<?php

use App\Organization;
use App\ResourceType;
use App\Setting;
use App\EvaluationItem;
use App\Http\Controllers\Admin\EvaluationItemController;
use App\PortfolioUnit;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    public function run()
    {
        foreach(Organization::withoutGlobalScopes()->select(['id', 'name'])->orderBy('id')->get() as $organization) {
            factory(Setting::class)->create([
                'organization_id' => $organization->id
            ]);

            foreach (ResourceType::CATEGORIES as $key => $value) {
                factory(ResourceType::class)->create([
                    'organization_id' => $organization->id,
                    'category' => $key,
                    'name' => $value
                ]);
            }

            factory(EvaluationItem::class, rand(10, 20))->create([
                'organization_id' => $organization->id
            ]);
            EvaluationItemController::updateWeightFactor(true);

            factory(PortfolioUnit::class)->create([
                'organization_id' => $organization->id,
                'name' => $organization->name.' Portfolio',
                'type' => PortfolioUnit::TYPE_PORTFOLIO
            ]);
        }
    }
}

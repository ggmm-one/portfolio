<?php

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
        factory(Setting::class)->create();

        foreach (ResourceType::CATEGORIES as $key => $value) {
            factory(ResourceType::class)->create([
                    'category' => $key,
                    'name' => $value
                ]);
        }

        factory(EvaluationItem::class, rand(10, 20))->create();
        EvaluationItemController::updateWeightFactor(true);

        factory(PortfolioUnit::class)->create([
                'name' => 'Main Portfolio',
                'type' => PortfolioUnit::TYPE_PORTFOLIO
            ]);
    }
}

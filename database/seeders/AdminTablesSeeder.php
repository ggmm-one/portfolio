<?php

namespace Database\Seeders;

use App\EvaluationItem;
use App\Portfolio;
use App\ResourceType;
use App\Services\ProjectScoringService;
use App\Setting;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    public function run()
    {
        Setting::factory()->create();

        foreach (ResourceType::CATEGORIES as $key => $value) {
            ResourceType::factory()->create([
                    'category' => $key,
                    'name' => $value,
                ]);
        }

        EvaluationItem::factory()->count(rand(10, 20))->create();
        (new ProjectScoringService)->updateWeightFactor();

        Portfolio::factory()->create([
                'name' => 'Main Portfolio',
            ]);
    }
}

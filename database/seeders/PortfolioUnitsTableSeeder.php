<?php

namespace Database\Seeders;

use App\Comment;
use App\Link;
use App\PortfolioUnit;
use App\Services\PortfolioHierarchyService;
use App\User;
use Illuminate\Database\Seeder;

class PortfolioUnitsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::select('id')->whereNull('deleted_at')->pluck('id');
        $root = PortfolioUnit::select('id')->whereNull('parent_id')->value('id');
        PortfolioUnit::factory()->count(rand(10, 20))->create([
                'parent_id' => $root,
                ])->each(function ($portfolio) use ($users) {
                    $portfolio->comments()->saveMany(Comment::factory()->count(rand(1, 10))->make([
                        'user_id' => $users->random(),
                    ]));
                    $portfolio->links()->saveMany(Link::factory()->count(rand(1, 3))->make([
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_GOAL,
                    ]));
                    $portfolio->links()->saveMany(Link::factory()->count(rand(5, 10))->make([
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_REPORT,
                    ]));
                    $portfolio->links()->saveMany(Link::factory()->count(rand(1, 5))->make([
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_OTHER,
                    ]));
                });
        (new PortfolioHierarchyService())->process();
    }
}

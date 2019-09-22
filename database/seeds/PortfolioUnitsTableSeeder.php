<?php

use App\Http\Controllers\Portfolio\PortfolioUnitController;
use Illuminate\Database\Seeder;
use App\PortfolioUnit;
use App\User;
use App\Comment;
use App\Link;

class PortfolioUnitsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::select('id')->whereNull('deleted_at')->pluck('id');
        $root = PortfolioUnit::select('id')->whereNull('parent_id')->value('id');
        factory(PortfolioUnit::class, rand(10, 20))->create([
                'parent_id' => $root
                ])->each(function ($portfolio) use ($users) {
                    $portfolio->comments()->saveMany(factory(Comment::class, rand(1, 10))->make([
                        'user_id' => $users->random()
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(1, 3))->make([
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_GOAL
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(5, 10))->make([
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_REPORT
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(1, 5))->make([
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_OTHER
                    ]));
                });
        PortfolioUnitController::processHierarchy();
    }
}

<?php

use App\Http\Controllers\Portfolio\PortfolioUnitController;
use Illuminate\Database\Seeder;
use App\PortfolioUnit;
use App\Organization;
use App\User;
use App\Comment;
use App\Link;

class PortfolioUnitsTableSeeder extends Seeder
{
    public function run()
    {
        foreach(Organization::withoutGlobalScopes()->select('id', 'name')->orderBy('id')->get() as $organization) {
            $users = User::withoutGlobalScopes()->select('id')->where('organization_id', $organization->id)->whereNull('deleted_at')->pluck('id');
            $root = PortfolioUnit::withoutGlobalScopes()->select('id')->whereNull('parent_id')->where('organization_id', $organization->id)->value('id');
            factory(PortfolioUnit::class, rand(10,20))->create([
                'organization_id' => $organization->id,
                'parent_id' => $root
                ])->each(function ($portfolio) use ($organization, $users) {
                    $portfolio->comments()->saveMany(factory(Comment::class, rand(1, 10))->make([
                        'organization_id' => $organization->id,
                        'user_id' => $users->random()
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(1, 3))->make([
                        'organization_id' => $organization->id,
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_GOAL
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(5, 10))->make([
                        'organization_id' => $organization->id,
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_REPORT
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(1, 5))->make([
                        'organization_id' => $organization->id,
                        'linkable_subtype' => Link::SUBTYPE_PORTFOLIO_OTHER
                    ]));
            });
            PortfolioUnitController::processHierarchy($organization->id);
        }
    }
}

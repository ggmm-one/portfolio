<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\Organization;
use App\User;
use App\PortfolioUnit;
use App\Comment;
use App\Link;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        foreach (Organization::withoutGlobalScopes()->select('id', 'name')->orderBy('id')->get() as $organization) {
            $users = User::withoutGlobalScopes()->select('id')->where('organization_id', $organization->id)->whereNull('deleted_at')->pluck('id');
            foreach (PortfolioUnit::withoutGlobalScopes()->select('id')->where('organization_id', $organization->id)->whereNull('deleted_at')->orderBy('id')->get() as $portfolioUnit) {
                factory(Project::class, rand(1, 10))->create([
                    'organization_id' => $organization->id,
                    'portfolio_unit_id' => $portfolioUnit->id
                ])->each(function ($portfolio) use ($organization, $users) {
                    $portfolio->comments()->saveMany(factory(Comment::class, rand(1, 10))->make([
                        'organization_id' => $organization->id,
                        'user_id' => $users->random()
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(1, 5))->make([
                        'organization_id' => $organization->id,
                        'linkable_subtype' => Link::SUBTYPE_PROJECT_OTHER
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(1, 5))->make([
                        'organization_id' => $organization->id,
                        'linkable_subtype' => Link::SUBTYPE_PROJECT_REPORT
                    ]));
                });
            }
        }
    }
}

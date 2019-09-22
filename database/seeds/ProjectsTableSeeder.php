<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\User;
use App\PortfolioUnit;
use App\Comment;
use App\Link;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::select('id')->whereNull('deleted_at')->pluck('id');
        foreach (PortfolioUnit::select('id')->whereNull('deleted_at')->orderBy('id')->get() as $portfolioUnit) {
            factory(Project::class, rand(1, 10))->create([
                    'portfolio_unit_id' => $portfolioUnit->id
                ])->each(function ($portfolio) use ($users) {
                    $portfolio->comments()->saveMany(factory(Comment::class, rand(1, 10))->make([
                        'user_id' => $users->random()
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(1, 5))->make([
                        'linkable_subtype' => Link::SUBTYPE_PROJECT_OTHER
                    ]));
                    $portfolio->links()->saveMany(factory(Link::class, rand(1, 5))->make([
                        'linkable_subtype' => Link::SUBTYPE_PROJECT_REPORT
                    ]));
                });
        }
    }
}

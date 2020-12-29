<?php

namespace Database\Seeders;

use App\Comment;
use App\Link;
use App\Portfolio;
use App\Project;
use App\User;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::select('id')->whereNull('deleted_at')->pluck('id');
        foreach (Portfolio::select('id')->whereNull('deleted_at')->orderBy('id')->get() as $portfolio) {
            Project::factory()->count(rand(1, 3))->create([
                    'portfolio_id' => $portfolio->id,
                ])->each(function ($portfolio) use ($users) {
                    $portfolio->comments()->saveMany(Comment::factory()->count(rand(1, 2))->make([
                        'user_id' => $users->random(),
                    ]));
                    $portfolio->links()->saveMany(Link::factory()->count(rand(1, 3))->make([
                        'linkable_subtype' => Link::SUBTYPE_PROJECT_OTHER,
                    ]));
                    $portfolio->links()->saveMany(Link::factory()->count(rand(1, 3))->make([
                        'linkable_subtype' => Link::SUBTYPE_PROJECT_REPORT,
                    ]));
                });
        }
    }
}

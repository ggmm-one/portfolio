<?php

namespace Database\Seeders;

use App\Comment;
use App\Resource;
use App\ResourceCapacity;
use App\ResourceOwner;
use App\ResourceType;
use App\User;
use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    public function run()
    {
        $types = ResourceType::select('id')->pluck('id');
        $users = User::select('id')->pluck('id');
        foreach (ResourceOwner::select('id', 'name')->orderBy('id')->get() as $owner) {
            Resource::factory()->count(rand(3, 5))->create([
                    'resource_owner_id' => $owner->id,
                    'resource_type_id' => $types->random(),
                ])->each(function ($resource) use ($users) {
                    $resource->comments()->saveMany(Comment::factory()->count(rand(1, 10))->make([
                        'user_id' => $users->random(),
                    ]));
                    $resource->capacities()->saveMany(ResourceCapacity::factory()->count(rand(1, 5))->make());
                });
        }
    }
}

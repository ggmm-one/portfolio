<?php

use App\Comment;
use App\Organization;
use App\Resource;
use App\ResourceOwner;
use App\ResourceType;
use App\ResourceCapacity;
use App\User;
use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    public function run()
    {
        foreach(Organization::withoutGlobalScopes()->select('id', 'name')->orderBy('id')->get() as $organization) {
            $types = ResourceType::withoutGlobalScopes()->select('id')->where('organization_id', $organization->id)->whereNull('deleted_at')->pluck('id');
            $users = User::withoutGlobalScopes()->select('id')->where('organization_id', $organization->id)->whereNull('deleted_at')->pluck('id');
            foreach(ResourceOwner::withoutGlobalScopes()->select('id', 'name')->where('organization_id', $organization->id)->whereNull('deleted_at')->orderBy('id')->get() as $owner) {
                factory(Resource::class, rand(3, 5))->create([
                    'organization_id' => $organization->id,
                    'resource_owner_id' => $owner->id,
                    'resource_type_id' => $types->random()
                ])->each(function ($resource) use ($organization, $users) {
                    $resource->comments()->saveMany(factory(Comment::class, rand(1,10))->make([
                        'organization_id' => $organization->id,
                        'user_id' => $users->random()
                    ]));
                    $resource->capacities()->saveMany(factory(ResourceCapacity::class, rand(1, 5))->make([
                        'organization_id' => $organization->id,
                    ]));
                });
            }
        }
    }
}

<?php

use App\Organization;
use App\ResourceOwner;
use Illuminate\Database\Seeder;

class ResourceOwnersTableSeeder extends Seeder
{
    public function run()
    {
        foreach(Organization::withoutGlobalScopes()->select('id', 'name')->orderBy('id')->get() as $organization) {
            factory(ResourceOwner::class, rand(20, 50))->create([
                'organization_id' => $organization->id,
            ]);
        }
    }
}

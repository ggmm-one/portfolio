<?php

use App\Organization;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        foreach(Organization::withoutGlobalScopes()->select('id')->orderBy('id')->get() as $organization) {
            factory(User::class, rand(5, 10))->create([
                'organization_id' => $organization->id
            ]);
            factory(User::class)->create([
                'organization_id' => $organization->id,
                'email' => $organization->id.'@admin.example.org'
            ]);
        }
    }
}

<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Role::class, 5)->create();
        factory(Role::class)->create([
            'name' => 'Admin',
            'permission_portfolios' => 'A',
            'permission_projects' => 'A',
            'permission_resources' => 'A',
            'permission_admin' => 'A',
        ]);
    }
}

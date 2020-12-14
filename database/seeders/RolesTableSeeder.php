<?php

namespace Database\Seeders;

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::factory()->create();
        Role::factory()->create([
            'name' => 'Admin',
            'permission_portfolios' => 'A',
            'permission_projects' => 'A',
            'permission_resources' => 'A',
            'permission_admin' => 'A',
        ]);
    }
}

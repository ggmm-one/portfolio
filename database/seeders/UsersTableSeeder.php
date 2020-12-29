<?php

namespace Database\Seeders;

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $roles = Role::select('id')->where('name', '<>', 'Admin')->pluck('id');
        $admin = Role::select('id')->where('name', 'Admin')->pluck('id');
        for ($i = 0; $i < rand(2, 6); $i++) {
            User::factory()->create([
                'role_id' => $roles->random(),
            ]);
        }
        User::factory()->create([
            'email' => 'admin@example.org',
            'password' => bcrypt('123123'),
            'role_id' => $admin->random(),
        ]);
    }
}

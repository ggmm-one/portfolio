<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $roles = Role::select('id')->where('name', '<>', 'Admin')->pluck('id');
        $admin = Role::select('id')->where('name', 'Admin')->pluck('id');
        for ($i = 0; $i < rand(10, 20); $i++) {
            factory(User::class)->create([
                'role_id' => $roles->random(),
            ]);
        }
        factory(User::class)->create([
            'email' => 'admin@example.org',
            'password' => bcrypt('123123'),
            'role_id' => $admin->random(),
        ]);
    }
}

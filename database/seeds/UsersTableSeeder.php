<?php

use App\Organization;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $types = ResourceType::select('id')->whereNull('deleted_at')->pluck('id');
        factory(User::class, rand(5, 10))->create();
        factory(User::class)->create([
                'email' => 'admin@example.org'
            ]);
    }
}

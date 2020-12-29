<?php

namespace Database\Seeders;

use App\ResourceOwner;
use Illuminate\Database\Seeder;

class ResourceOwnersTableSeeder extends Seeder
{
    public function run()
    {
        ResourceOwner::factory()->count(rand(2, 10))->create();
    }
}

<?php

use App\ResourceOwner;
use Illuminate\Database\Seeder;

class ResourceOwnersTableSeeder extends Seeder
{
    public function run()
    {
        factory(ResourceOwner::class, rand(20, 50))->create();
    }
}

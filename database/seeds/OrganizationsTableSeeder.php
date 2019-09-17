<?php

use App\Organization;
use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Organization::class)->create();
    }
}

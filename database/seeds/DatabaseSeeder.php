<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();
        $this->call(AdminTablesSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ResourceOwnersTableSeeder::class);
        $this->call(ResourcesTableSeeder::class);
        $this->call(PortfolioUnitsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(EvaluationScoresTableSeeder::class);
        DB::commit();
    }
}

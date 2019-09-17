<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::raw('PRAGMA synchronous=OFF');
        DB::raw('PRAGMA journal_mode=OFF');
        DB::raw('PRAGMA count_changes=OFF');
        DB::raw('PRAGMA temp_store=OFF');
        DB::beginTransaction();
        $this->call(OrganizationsTableSeeder::class);
        $this->call(AdminTablesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ResourceOwnersTableSeeder::class);
        $this->call(ResourcesTableSeeder::class);
        $this->call(PortfolioUnitsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(EvaluationScoresTableSeeder::class);
        DB::commit();
    }
}

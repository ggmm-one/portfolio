<?php

namespace App\Providers;

use App\Portfolio;
use App\Project;
use App\Resource;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->bootBlade();
        $this->bootBlueprint();
        $this->bootRelation();
    }

    private function bootBlade()
    {
        Paginator::useBootstrap();
    }

    private function bootBlueprint()
    {
        Blueprint::macro('modelHeader', function () {
            $this->bigIncrements('id');
        });
        Blueprint::macro('modelFooter', function () {
            $this->timestamps();
            $this->softDeletes();
        });
    }

    private function bootRelation()
    {
        Relation::morphMap([
            Portfolio::MORPH_SHORT_NAME => '\App\Portfolio',
            Project::MORPH_SHORT_NAME => '\App\Project',
            Resource::MORPH_SHORT_NAME => '\App\Resource',
        ]);
    }
}

<?php

namespace App\Providers;

use App\PortfolioUnit;
use App\Project;
use App\Resource;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        $this->bootRequest();
    }

    private function bootBlade()
    {
        Blade::include('components.page-title', 'page_title');
        Blade::include('inc.form.input', 'form_input');
        Blade::include('inc.form.select', 'form_select');
        Blade::include('inc.form.textarea', 'form_textarea');
        Blade::include('inc.form.submit', 'form_submit');
        Blade::directive('activeTab', function ($expression) {
            return "<?php echo Str::startsWith(Route::currentRouteName(), {$expression}) ? 'active' : '' ?>";
        });

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
            PortfolioUnit::MORPH_SHORT_NAME => 'App\PortfolioUnit',
            Project::MORPH_SHORT_NAME => 'App\Project',
            Resource::MORPH_SHORT_NAME => 'App\Resource',
        ]);
    }

    private function bootRequest()
    {
        Request::macro('setFiltered', function () {
            $this->merge(['is_filtered' => 'true']);
        });
        Request::macro('isFiltered', function () {
            return $this->has('is_filtered');
        });
    }
}

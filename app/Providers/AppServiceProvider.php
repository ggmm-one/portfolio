<?php

namespace App\Providers;

use App\Project;
use App\PortfolioUnit;
use App\Resource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;

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
        Blade::include('inc.form.input', 'form_input');
        Blade::include('inc.form.select', 'form_select');
        Blade::include('inc.form.textarea', 'form_textarea');
        Blade::include('inc.form.public_id', 'form_public_id');
        Blade::include('inc.form.submit', 'form_submit');
        Blade::directive('activeTab', function($expression) {
            return "<?php echo Str::startsWith(Route::currentRouteName(), {$expression}) ? 'active' : '' ?>";
        });
    }

    private function bootBlueprint()
    {
        Blueprint::macro('modelHeader', function() {
            $this->bigIncrements('id');
            $this->char('pid', 11);
            $this->bigInteger('organization_id');
            $this->unique('pid', 'ux_'.$this->getTable().'_pid');
            $this->index('organization_id', 'ix_'.$this->getTable().'_organization_id');
            $this->foreign('organization_id', 'fk_'.$this->getTable().'_organization_id')->references('id')->on('organizations');
        });
        Blueprint::macro('modelFooter', function() {
            $this->timestamps();
            $this->softDeletes();
        });
    }

    private function bootRelation()
    {
        Relation::morphMap([
            PortfolioUnit::MORPH_SHORT_NAME => 'App\PortfolioUnit',
            Project::MORPH_SHORT_NAME => 'App\Project',
            Resource::MORPH_SHORT_NAME => 'App\Resource'
        ]);
    }

    private function bootRequest()
    {
        Request::macro('setFiltered', function() {
            $this->merge(['is_filtered' => 'true']);
        });
        Request::macro('isFiltered', function() {
            return $this->has('is_filtered');
        });
    }
}

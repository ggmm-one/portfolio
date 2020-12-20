<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapAppRoutes();
        $this->mapNoAuthRoutes();
    }

    protected function mapAppRoutes()
    {
        Route::middleware('app')
             ->namespace($this->namespace)
             ->group(base_path('routes/app.php'));
    }

    protected function mapNoAuthRoutes()
    {
        Route::middleware('no_auth')
             ->namespace($this->namespace)
             ->group(base_path('routes/no_auth.php'));
    }
}

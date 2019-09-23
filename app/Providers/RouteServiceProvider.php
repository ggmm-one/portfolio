<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
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

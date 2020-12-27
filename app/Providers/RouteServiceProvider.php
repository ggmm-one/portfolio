<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * @codeCoverageIgnore
 */
class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';
    public const AUTH_LOGIN = '/auth/login';

    protected $namespace = 'App\\Http\\Controllers';

    public function boot()
    {
        $this->routes(function () {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }
}

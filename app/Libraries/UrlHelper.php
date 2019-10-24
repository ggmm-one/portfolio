<?php

use App\PortfolioUnit;
use App\Resource;
use Illuminate\Support\Facades\Route;

final class UrlHelper
{
    public static function commentUrl(string $action, $commentPid)
    {
        $route = explode('.', Route::currentRouteName());
        $route[2] = $action;

        $params = ['comment' => $commentPid];
        switch ($route[0]) {
            case 'resources': $params['resource'] = request()->resource; break;
            case 'portfolios': $params['portfolio_unit'] = request()->portfolio_unit; break;
        }

        return route(implode('.', $route), $params).($action == 'edit' ? '#'.$commentPid : '');
    }

    public static function commentType()
    {
        switch (explode('.', Route::currentRouteName())[0]) {
            case 'resources': return Resource::class;
            case 'portfolios': return PortfolioUnit::class;
        }
    }
}

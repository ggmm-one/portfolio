<?php

use App\Resource;
use Illuminate\Support\Facades\Route;

final class UrlHelper
{
    public static function commentUrl(string $action, $commentPid)
    {
        $route = explode('.', Route::currentRouteName());
        $route[2] = $action;

        $params = ['comment' => $commentPid];
        if ($route[0] == 'resources') {
            $params['resource'] = request()->resource;
        }

        return route(implode('.', $route), $params).($action == 'edit' ? '#'.$commentPid : '');
    }

    public static function commentType()
    {
        switch (explode('.', Route::currentRouteName())[0]) {
            case 'resources': return Resource::class;
        }
    }
}

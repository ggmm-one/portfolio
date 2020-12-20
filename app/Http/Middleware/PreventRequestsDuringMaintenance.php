<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * @codeCoverageIgnore
 */
class PreventRequestsDuringMaintenance extends Middleware
{
    protected $except = [];
}

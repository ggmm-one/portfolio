<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * @codeCoverageIgnore
 */
class VerifyCsrfToken extends Middleware
{
    protected $except = [];
}

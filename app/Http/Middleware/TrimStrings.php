<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * @codeCoverageIgnore
 */
class TrimStrings extends Middleware
{
    protected $except = [
        'password',
        'password_confirmation',
    ];
}

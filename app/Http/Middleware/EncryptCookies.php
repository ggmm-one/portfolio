<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * @codeCoverageIgnore
 */
class EncryptCookies extends Middleware
{
    protected $except = [];
}

<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait PublicAddressable
{
    public static function bootPublicAddressable()
    {
        self::creating(function ($model) {
            $model->pid = Str::random(11);
        });
    }

    public function getRouteKeyName()
    {
        return 'pid';
    }
}

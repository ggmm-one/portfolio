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

    public static function getId($pid)
    {
        return self::where('pid', $pid)->value('id');
    }

    public static function getPid($id)
    {
        return self::where('id', $id)->value('pid');
    }
}

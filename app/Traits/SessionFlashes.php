<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

trait SessionFlashes
{
    public static function bootSessionFlashes()
    {
        self::created(function ($model) {
            Session::flash('flash-success', $model->getSessionFlashName().' Added');
        });

        self::updated(function ($model) {
            Session::flash('flash-success', $model->getSessionFlashName().' Updated');
        });

        self::deleted(function ($model) {
            Session::flash('flash-success', $model->getSessionFlashName().' Deleted');
        });
    }

    public function getSessionFlashName() : string
    {
        return implode(' ', preg_split('/(?=[A-Z])/', Str::after(get_class($this), '\\')));
    }

}

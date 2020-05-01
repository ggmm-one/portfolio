<?php

namespace App\Traits;

use Ggmm\Model\HasModelDisplayName;
use Illuminate\Support\Facades\Session;

trait SessionFlashes
{
    use HasModelDisplayName;

    public static function bootSessionFlashes()
    {
        self::created(function ($model) {
            Session::flash('flash-success', $model->getModelDisplayName().' Added');
        });

        self::updated(function ($model) {
            Session::flash('flash-success', $model->getModelDisplayName().' Updated');
        });

        self::deleted(function ($model) {
            Session::flash('flash-success', $model->getModelDisplayName().' Deleted');
        });
    }
}

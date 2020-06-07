<?php

namespace App;

use App\Traits\DeletesIfNotReferenced;
use App\Traits\HasHashid;
use App\Traits\SessionFlashes;
use Ggmm\Model\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model as LaravelModel;
use Mtvs\EloquentHashids\HashidRouting;

abstract class Model extends LaravelModel
{
    use HasHashid;
    use HashidRouting;
    use DeletesIfNotReferenced;
    use CascadeSoftDeletes;
    use SessionFlashes;

    public const DD_DATE_MIN = '1900-01-01';
    public const DD_DATE_MAX = '2199-12-31';

    protected $hidden = ['id'];
}

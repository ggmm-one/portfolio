<?php

namespace App;

use App\Traits\CascadeSoftDeletes;
use App\Traits\CheckBeforeDeletes;
use App\Traits\PublicAddressable;
use App\Traits\SessionFlashes;
use Illuminate\Database\Eloquent\Model as LaravelModel;

abstract class Model extends LaravelModel
{
    use PublicAddressable;
    use CheckBeforeDeletes;
    use CascadeSoftDeletes;
    use SessionFlashes;

    public const DD_DATE_MIN = '1900-01-01';
    public const DD_DATE_MAX = '2199-12-31';

    protected $hidden = ['id'];
}

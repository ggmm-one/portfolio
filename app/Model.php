<?php

namespace App;

use App\Traits\DeletesIfNotReferenced;
use App\Traits\SessionFlashes;
use Ggmm\Model\CascadeSoftDeletes;
use Ggmm\Model\HasHashid;
use Ggmm\Model\HashidRoutable;
use Ggmm\Model\HasOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as LaravelModel;

abstract class Model extends LaravelModel
{
    use DeletesIfNotReferenced;
    use CascadeSoftDeletes;
    use SessionFlashes;
    use HasHashid;
    use HashidRoutable;
    use HasOrder;
    use HasFactory;

    public const DD_DATE_MIN = '1900-01-01';
    public const DD_DATE_MAX = '2199-12-31';

    protected $hidden = ['id'];
}

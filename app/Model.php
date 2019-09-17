<?php

namespace App;

use Illuminate\Database\Eloquent\Model as LaravelModel;

abstract class Model extends LaravelModel
{
    use Traits\PublicAddressable;
    use Traits\OrganizationBoundable;
    use Traits\CheckBeforeDeletes;
    use Traits\CascadeSoftDeletes;
    use Traits\SessionFlashes;

    public const DD_DATE_MIN = '1900-01-01';
    public const DD_DATE_MAX = '2199-12-31';

    protected $hidden = [
        'id'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
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

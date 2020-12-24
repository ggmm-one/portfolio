<?php

namespace App;

class ResourceCapacity extends Model
{
    public const TYPE_UNLIMITED = 'U';
    public const TYPE_PERIOD = 'P';
    public const TYPE_MONTH = 'M';
    public const TYPE_YEAR = 'Y';
    public const TYPES = [
        self::TYPE_UNLIMITED => 'Unlimited',
        self::TYPE_PERIOD => 'Per Period',
        self::TYPE_YEAR => 'Per Year',
        self::TYPE_MONTH => 'Per Month',
    ];

    public const DD_QUANTITY_MAX = PHP_INT_MAX / 2;

    protected $fillable = [
        'start', 'end', 'quantity', 'type',
    ];

    protected $attributes = [
        'quantity' => 0,
        'type' => self::TYPE_UNLIMITED,
    ];

    protected $dates = [
        'start', 'end',
    ];

    protected $hasOrder = ['start'];

    public function getTypeNameAttribute()
    {
        return self::TYPES[$this->type];
    }
}

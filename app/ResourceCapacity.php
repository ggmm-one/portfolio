<?php

namespace App;

class ResourceCapacity extends Model
{
    public const DD_QUANTITY_MAX = PHP_INT_MAX / 2;

    protected $fillable = [
        'start', 'end', 'quantity',
    ];

    protected $dates = [
        'start', 'end',
    ];

    protected $hasOrder = ['start', 'end'];
}

<?php

namespace App;

class Setting extends Model
{
    public const DD_EVALUATION_MAX = 100;

    protected $fillable = [
        'evaluation_max',
    ];
}

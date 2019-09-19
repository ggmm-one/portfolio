<?php

namespace App;

use App\Model;

class Role extends Model
{
    public const DD_NAME_LENGTH = 256;

    protected $fillable = ['name'];
}

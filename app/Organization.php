<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Traits\PublicAddressable;
use App\Traits\SessionFlashes;

class Organization extends Model
{
    use PublicAddressable;
    use SessionFlashes;

    public const DD_NAME_LENGTH = 256;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'id'
    ];
}

<?php

namespace App\Traits;

use App\Link;

trait HasLinks
{
    public function links()
    {
        return $this->morphMany(Link::class, 'linkable');
    }
}

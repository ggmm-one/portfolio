<?php

namespace App\Traits;

trait HasHashid
{
    use \Mtvs\EloquentHashids\HasHashid;

    public function getHashidAttribute()
    {
        return $this->hashid();
    }
}

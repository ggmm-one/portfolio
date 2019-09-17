<?php

use Illuminate\Support\Str;

class Lorem extends Faker\Provider\Base
{
    public function loremTitle($words = 3)
    {
        return Str::title($this->generator->words($words, true));
    }
}

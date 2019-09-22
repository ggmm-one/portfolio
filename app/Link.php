<?php

namespace App;

use App\Model;

class Link extends Model
{
    public const DD_TITLE_LENGTH = 256;
    public const DD_URL_LENGTH = 2048;
    public const DD_SORT_ORDER_MAX = 1024;

    public const SUBTYPE_PORTFOLIO_GOAL = 'G';
    public const SUBTYPE_PORTFOLIO_REPORT = 'R';
    public const SUBTYPE_PORTFOLIO_OTHER = 'X';
    public const SUBTYPE_PROJECT_REPORT = 'T';
    public const SUBTYPE_PROJECT_OTHER = 'Z';

    protected $fillable = [
        'title', 'url', 'sort_order'
    ];

    protected $attributes = [
        'title' => '',
        'url' => '',
        'sort_order' => 0
    ];

    public function linkable()
    {
        return $this->morphTo();
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}

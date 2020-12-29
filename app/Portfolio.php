<?php

namespace App;

use App\Traits\HasComments;
use App\Traits\HasLinks;

class Portfolio extends Model
{
    use HasComments;
    use HasLinks;

    public const MORPH_SHORT_NAME = 'por';

    public const DD_NAME_LENGTH = 256;
    public const DD_DESCRIPTION_LENGTH = 4000;

    protected $cascadeDelete = [
        'comments',
        'links',
    ];

    protected $fillable = [
        'name', 'parent_id', 'description',
    ];

    protected $hasOrder = ['name'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function isRoot()
    {
        return $this->parent_id == null;
    }

    public function scopeSelectList($query, $arg = -1)
    {
        return $query->select('id', 'name')->where('id', '<>', $arg)->orderBy('name');
    }

    public function scopeHierarchyOrdered($query)
    {
        return $query->orderBy('hierarchy_order')->orderBy('name');
    }
}

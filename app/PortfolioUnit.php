<?php

namespace App;

use App\Traits\HasComments;
use App\Traits\HasLinks;
use Illuminate\Validation\ValidationException;

class PortfolioUnit extends Model
{
    use HasComments;
    use HasLinks;

    public const MORPH_SHORT_NAME = 'pun';

    public const DD_NAME_LENGTH = 256;
    public const DD_DESCRIPTION_LENGTH = 4000;

    public const TYPE_PORTFOLIO = 'P';
    public const TYPE_PROGRAM = 'R';
    public const TYPES = [self::TYPE_PORTFOLIO => 'Portfolio', self::TYPE_PROGRAM => 'Program'];

    protected $cascadeDelete = [
        'comments',
        'links',
    ];

    public const CHECK_BEFORE_DELETING = [
        [self::class, 'parent_id', 'Cannot delete portfolio. Please re-assign sub portfolios and try again.'],
        [Project::class, 'portfolio_unit_id', 'Cannot delete portfolio. Please re-assign projects and try again.'],
    ];

    protected $fillable = [
        'name', 'type', 'parent_hashid', 'description',
    ];

    protected $attributes = [
        'name' => 'New Portfolio',
        'type' => self::TYPE_PORTFOLIO,
    ];

    protected $hasOrder = ['name'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function isRoot()
    {
        return $this->exists && $this->parent_id == null;
    }

    public function getTypeNameAttribute()
    {
        return self::TYPES[$this->type];
    }

    protected function checkBeforeDeleting()
    {
        if ($this->isRoot()) {
            throw ValidationException::withMessages(['check_before_deleting' => 'Cannot delete default portfolio']);
        }
    }

    public static function getSelectList(self $portfolioUnit = null)
    {
        $root = self::select('id', 'name')->whereNull('parent_id');
        $query = self::select('id', 'name')->union($root)->whereNotNull('parent_id')->ordered();
        if ($portfolioUnit) {
            $query->where('id', '<>', $portfolioUnit->id);
        }

        return $query->get()->pluck('name', 'hashid');
    }

    public function scopeHierarchyOrdered($query)
    {
        return $query->orderBy('hierarchy_order');
    }
}

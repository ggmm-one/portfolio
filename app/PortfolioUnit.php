<?php

namespace App;

use Illuminate\Validation\ValidationException;

class PortfolioUnit extends Model
{
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
        'name', 'type', 'parent_pid', 'description',
    ];

    protected $attributes = [
        'name' => 'New Portfolio',
        'type' => self::TYPE_PORTFOLIO,
    ];

    public function links()
    {
        return $this->morphMany(Link::class, 'linkable');
    }

    public function getGoalsAttribute()
    {
        return Link::where('linkable_type', self::MORPH_SHORT_NAME)
            ->where('linkable_id', $this->id)
            ->where('linkable_subtype', Link::SUBTYPE_PORTFOLIO_GOAL)
            ->ordered()
            ->get();
    }

    public function getReportsAttribute()
    {
        return Link::where('linkable_type', self::MORPH_SHORT_NAME)
            ->where('linkable_id', $this->id)
            ->where('linkable_subtype', Link::SUBTYPE_PORTFOLIO_REPORT)
            ->ordered()
            ->get();
    }

    public function getOtherLinksAttribute()
    {
        return Link::where('linkable_type', self::MORPH_SHORT_NAME)
            ->where('linkable_id', $this->id)
            ->where('linkable_subtype', Link::SUBTYPE_PORTFOLIO_OTHER)
            ->ordered()
            ->get();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

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

    /**
     * Sets the id for the parent, given the parent's public id.
     *
     * @param string pid The parent's public id
     *
     * @return void
     */
    public function setParentPidAttribute($pid)
    {
        $this->parent_id = self::getId($pid);
        if ($this->parent_id == null) {
            abort(400);
        }
    }

    public function getParentPidAttribute()
    {
        return $this->exists ? ($this->parent_id == null ? $this->pid : $this->parent->pid) : null;
    }

    protected function checkBeforeDeleting()
    {
        if ($this->isRoot()) {
            throw ValidationException::withMessages(['check_before_deleting' => 'Cannot delete default portfolio']);
        }
    }

    public static function getSelectList(self $portfolioUnit = null)
    {
        $root = self::select('pid', 'name')->whereNull('parent_id');
        $query = self::select('pid', 'name')->union($root)->whereNotNull('parent_id')->ordered();
        if ($portfolioUnit) {
            $query->where('pid', '<>', $portfolioUnit->pid);
        }

        return $query->get()->pluck('name', 'pid');
    }

    public function scopeHierarchyOrdered($query)
    {
        return $query->orderBy('hierarchy_order');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }
}

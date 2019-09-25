<?php

namespace App;

use App\Model;

class ResourceType extends Model
{
    public const DD_NAME_LENGTH = 256;

    public const CATEGORY_FINANCIAL = 'F';
    public const CATEGORY_HUMAN = 'H';
    public const CATEGORY_ASSETS = 'O';
    public const CATEGORY_INTELLECTUAL = 'P';
    public const CATEGORIES = [
        self::CATEGORY_FINANCIAL => 'Financial',
        self::CATEGORY_HUMAN => 'Human',
        self::CATEGORY_ASSETS => 'Assets',
        self::CATEGORY_INTELLECTUAL => 'Intellectual'
    ];

    public const CHECK_BEFORE_DELETING = [
        [Resource::class, 'resource_type_id', 'Cannot delete resource type. Please re-assign types on resources and try again.']
    ];

    protected $fillable = [
        'name', 'category'
    ];

    protected $attributes = [
        'name' => '',
        'category' => self::CATEGORY_FINANCIAL,
    ];

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function getCategoryNameAttribute()
    {
        return self::CATEGORIES[$this->category];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }

    public static function getSelectList()
    {
        return ResourceType::ordered()->get()->pluck('name', 'pid');
    }
}

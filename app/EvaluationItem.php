<?php

namespace App;

use App\Model;

class EvaluationItem extends Model
{
    public const DD_NAME_LENGTH = 256;
    public const DD_INSTRUCTIONS_LENGTH = 4000;
    public const DD_WEIGHT_MAX = 100;
    public const DD_SORT_ORDER_MAX = 1024;

    public const CASCADE = [
        'evaluationScores'
    ];

    protected $fillable = [
        'name', 'instructions', 'weight', 'sort_order'
    ];

    protected $casts = [
        'sort_order' => 'integer'
    ];

    public function evaluationScores()
    {
        return $this->hasMany(EvaluationScore::class);
    }

    public function setWeightAttribute($value)
    {
        $this->attributes['weight'] = $value;
        $this->attributes['weight_factor'] = $value;
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order');
    }
}

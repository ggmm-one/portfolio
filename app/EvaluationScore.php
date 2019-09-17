<?php

namespace App;

use App\Model;

class EvaluationScore extends Model
{
    public const DD_DESCRIPTION_LENGTH = 4000;

    protected $fillable = [
        'score', 'description'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function evaluationItem()
    {
        return $this->belongsTo(EvaluationItem::class);
    }

    public function setScoreAttribute($value) {
        $this->attributes['score'] = $value;
        $this->attributes['weighted_score'] = $value;
    }

    public function getFormattedWeightedScoreAttribute()
    {
        return number_format($this->attributes['weighted_score'], 2);
    }

}

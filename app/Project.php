<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    public const MORPH_SHORT_NAME = 'prj';

    public const DD_NAME_LENGTH = 1024;
    public const DD_CODE_LENGTH = 64;
    public const DD_DESCRIPTION_LENGTH = 4000;
    public const DD_DURATION_MAX = 1200;

    public const TYPE_PROJECT = 'P';
    public const TYPE_WORK_ITEM = 'W';
    public const TYPES = [
        self::TYPE_PROJECT => 'Project',
        self::TYPE_WORK_ITEM => 'Work Item'
    ];

    public const STATUS_DRAFT = 'D';
    public const STATUS_INITIATION = 'I';
    public const STATUS_WAITING_APPROVAL = 'W';
    public const STATUS_APPROVED = 'A';
    public const STATUS_IN_PROGRESS = 'P';
    public const STATUS_CLOSED = 'C';
    public const STATUS_CANCELLED = 'X';
    public const STATUS = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_INITIATION => 'Initiation',
        self::STATUS_WAITING_APPROVAL => 'Waiting Approval',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_IN_PROGRESS => 'In Progress',
        self::STATUS_CLOSED => 'Closed',
        self::STATUS_CANCELLED => 'Cancelled'
    ];

    public const CASCADE = [
        'comments',
        'links',
        'evaluationScores'
    ];

    protected $fillable = [
        'type', 'status', 'name', 'code', 'portfolio_unit_pid', 'start', 'duration', 'start_after', 'end_before'
    ];

    protected $dates = [
        'start', 'start_after', 'end_before'
    ];

    protected $attributes = [
        'name' => 'New Project',
        'type' => Project::TYPE_PROJECT,
        'status' => Project::STATUS_DRAFT
    ];

    public function portfolio()
    {
        return $this->belongsTo(PortfolioUnit::class, 'portfolio_unit_id');
    }

    public function evaluationScores()
    {
        return $this->hasMany(EvaluationScore::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function links()
    {
        return $this->morphMany(Link::class, 'linkable');
    }

    public function beforeProjects()
    {
        return $this->hasMany(ProjectOrderConstraint::class, 'before_project_id');
    }

    public function afterProjects()
    {
        return $this->hasMany(ProjectOrderConstraint::class, 'after_project_id');
    }

    public function getOtherLinksAttribute()
    {
        return Link::where('linkable_type', self::MORPH_SHORT_NAME)
            ->where('linkable_id', $this->id)
            ->where('linkable_subtype', Link::SUBTYPE_PROJECT_OTHER)
            ->ordered()
            ->get();
    }

    public function getReportsAttribute()
    {
        return Link::where('linkable_type', self::MORPH_SHORT_NAME)
            ->where('linkable_id', $this->id)
            ->where('linkable_subtype', Link::SUBTYPE_PROJECT_REPORT)
            ->ordered()
            ->get();
    }

    public function getFormattedScoreAttribute()
    {
        return number_format($this->attributes['score'], 2);
    }

    public function getConstraintProjectsSelect()
    {
        $projectId = $this->id;
        return Project::select('id', 'pid', 'name')
            ->where('id', '<>', $projectId)
            ->whereNotIn('id', function ($query) use ($projectId) {
                $query->select('after_project_id')->from('project_order_constraints')->where('before_project_id', $projectId)->whereNull('deleted_at');
            })
            ->ordered()->get()->pluck('name', 'pid');
    }

    public function setPortfolioUnitPidAttribute($pid)
    {
        $this->portfolio_unit_id = PortfolioUnit::select('id')->where('pid', $pid)->value('id');
        if ($this->portfolio_unit_id == null) {
            abort(400);
        }
    }

    public function getPortfolioUnitPidAttribute()
    {
        return $this->exists? $this->portfolio->pid : null;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }
}

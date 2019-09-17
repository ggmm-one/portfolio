<?php

namespace App\Traits;

use App\Scopes\OrganizationScope;
use Illuminate\Support\Facades\Auth;

trait OrganizationBoundable
{
    public static function bootOrganizationBoundable()
    {
        static::addGlobalScope(new OrganizationScope());
        self::creating(function ($model) {
            if (!isset($model->organization_id)) {
                $model->organization_id = Auth::user()->organization_id;
            }
        });
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}

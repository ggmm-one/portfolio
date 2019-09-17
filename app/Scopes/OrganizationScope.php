<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class OrganizationScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $organizationId = Auth::user()->organization_id ?? -1;
        $builder->where($model->qualifyColumn('organization_id'), '=', $organizationId);
    }
}

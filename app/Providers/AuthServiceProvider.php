<?php

namespace App\Providers;

use App\EvaluationItem;
use App\Policies\AdminModulePolicy;
use App\ResourceType;
use App\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        EvaluationItem::class => AdminModulePolicy::class,
        ResourceType::class => AdminModulePolicy::class,
        Role::class => AdminModulePolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

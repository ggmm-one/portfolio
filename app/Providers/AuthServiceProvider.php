<?php

namespace App\Providers;

use App\EvaluationItem;
use App\Policies\AdminModulePolicy;
use App\Policies\ResourcesModulePolicy;
use App\ResourceOwner;
use App\ResourceType;
use App\ResourceCapacity;
use App\Resource;
use App\Role;
use App\Setting;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        EvaluationItem::class => AdminModulePolicy::class,
        Resource::class => ResourcesModulePolicy::class,
        ResourceCapacity::class => ResourcesModulePolicy::class,
        ResourceOwner::class => ResourcesModulePolicy::class,
        ResourceType::class => AdminModulePolicy::class,
        Role::class => AdminModulePolicy::class,
        Setting::class => AdminModulePolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

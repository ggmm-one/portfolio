<?php

namespace App\Providers;

use App\Policies\AdminModulePolicy;
use App\ResourceType;
use App\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ResourceType::class => AdminModulePolicy::class,
        Role::class => AdminModulePolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

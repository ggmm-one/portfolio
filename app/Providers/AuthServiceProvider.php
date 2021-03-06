<?php

namespace App\Providers;

use App\Comment;
use App\EvaluationItem;
use App\EvaluationScore;
use App\Policies\AdminModulePolicy;
use App\Policies\CommentPolicy;
use App\Policies\LinkPolicy;
use App\Policies\PortfoliosModulePolicy;
use App\Policies\ProjectsModulePolicy;
use App\Policies\ResourcesModulePolicy;
use App\Portfolio;
use App\Project;
use App\ProjectOrderConstraint;
use App\Resource;
use App\ResourceAllocation;
use App\ResourceCapacity;
use App\ResourceOwner;
use App\ResourceType;
use App\Role;
use App\Setting;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Comment::class => CommentPolicy::class,
        EvaluationItem::class => AdminModulePolicy::class,
        EvaluationScore::class => ProjectsModulePolicy::class,
        Link::class => LinkPolicy::class,
        Portfolio::class => PortfoliosModulePolicy::class,
        Project::class => ProjectsModulePolicy::class,
        ProjectOrderConstraint::class => ProjectsModulePolicy::class,
        Resource::class => ResourcesModulePolicy::class,
        ResourceAllocation::class => ProjectsModulePolicy::class,
        ResourceCapacity::class => ResourcesModulePolicy::class,
        ResourceOwner::class => ResourcesModulePolicy::class,
        ResourceType::class => AdminModulePolicy::class,
        Role::class => AdminModulePolicy::class,
        Setting::class => AdminModulePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

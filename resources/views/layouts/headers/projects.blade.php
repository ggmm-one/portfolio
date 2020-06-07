<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ $project->name }}</span>
    <div>
        @if (Request::route()->getName() == 'projects.edit')
        <x-delete-model :model="$project" class="btn btn-primary" />
        @endif
    </div>
</nav>
<ul class="nav nav-tabs bg-light app-nav-section">
    <li class="nav-item"><a href="{{ route('projects.edit', compact('project')) }}" class="nav-link @activeTab('projects.edit')">{{ __('Info') }}</a></li>
    @if($project->exists)
    <li class="nav-item"><a href="{{ route('resource_allocations.index', compact('project')) }}" class="nav-link @activeTab('projects.resources')">{{ __('Resources') }}</a></li>
    <li class="nav-item"><a href="{{ route('evaluation_scores.index', compact('project')) }}" class="nav-link @activeTab('evaluation_scores')">{{ __('Evaluation') }}</a></li>
    <li class="nav-item"><a href="{{ route('project_order_constraints.index', compact('project')) }}" class="nav-link @activeTab('project_order_constraints')">{{ __('Constraints') }}</a></li>
    <li class="nav-item"><a href="{{ route('projects.reports.index', compact('project')) }}" class="nav-link @activeTab('projects.reports')">{{ __('Reports') }}</a></li>
    <li class="nav-item"><a href="{{ route('projects.links.index', compact('project')) }}" class="nav-link @activeTab('projects.links')">{{ __('Links') }}</a></li>
    <li class="nav-item"><a href="{{ route('projects.comments.index', compact('project')) }}" class="nav-link @activeTab('projects.comments')">{{ __('Comments') }}</a></li>
    @endif
</ul>

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ $project->name }}</span>
    <div>
        @includeWhen($project->exists && auth()->user()->can('delete', $project), 'inc.delete_btn', ['deleteAction' => route('projects.destroy', ['project' => '$project->pid'])])
    </div>
</nav>
<ul class="nav nav-tabs bg-light app-nav-section">
    <li class="nav-item"><a href="{{ route('projects.edit', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects')">{{ __('Info') }}</a></li>
    @if($project->exists)
    <li class="nav-item"><a href="{{ route('resource_allocations.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects.resources')">{{ __('Resources') }}</a></li>
    <li class="nav-item"><a href="{{ route('evaluation_scores.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('evaluation_scores')">{{ __('Evaluation') }}</a></li>
    <li class="nav-item"><a href="{{ route('project_order_constraints.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('project_order_constraints')">{{ __('Constraints') }}</a></li>
    <li class="nav-item"><a href="" class="nav-link @activeTab('projects.reports')">{{ __('Reports') }}</a></li>
    <li class="nav-item"><a href="" class="nav-link @activeTab('projects.links')">{{ __('Links') }}</a></li>
    <li class="nav-item"><a href="" class="nav-link @activeTab('projects.comments')">{{ __('Comments') }}</a></li>
    @endif
</ul>

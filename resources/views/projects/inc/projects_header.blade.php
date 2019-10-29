<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ $project->name }}</span>
    <div>
        @includeWhen($project->exists && auth()->user()->can('delete', $project), 'inc.delete_btn', ['deleteAction' => route('projects.projects.destroy', ['project' => $project->pid])])
    </div>
</nav>
<ul class="nav nav-tabs bg-light app-nav-section">
    <li class="nav-item"><a href="{{ route('projects.projects.edit', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects.projects')">{{ __('Info') }}</a></li>
    @if($project->exists)
        <li class="nav-item"><a href="{{ route('projects.resources.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects.resources')">{{ __('Resources') }}</a></li>
        <li class="nav-item"><a href="{{ route('projects.evaluations.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects.evaluations')">{{ __('Evaluation') }}</a></li>
        <li class="nav-item"><a href="{{ route('projects.constraints.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects.constraints')">{{ __('Constraints') }}</a></li>
        <li class="nav-item"><a href="{{ route('projects.reports.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects.reports')">{{ __('Reports') }}</a></li>
        <li class="nav-item"><a href="{{ route('projects.links.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects.links')">{{ __('Links') }}</a></li>
        <li class="nav-item"><a href="{{ route('projects.comments.index', ['project' => $project->pid]) }}" class="nav-link @activeTab('projects.comments')">{{ __('Comments') }}</a></li>
    @endif
</ul>
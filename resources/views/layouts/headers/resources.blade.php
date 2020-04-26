@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ $resource->name }}</span>
    <div>
        @includeWhen($resource->exists && auth()->user()->can('delete', $resource), 'inc.delete_btn', ['deleteAction' => route('resources.destroy', ['resource' => $resource->pid])])
    </div>
</nav>
<ul class="nav nav-tabs bg-light app-nav-section">
    <li class="nav-item"><a href="{{ route('resources.edit', ['resource' => $resource]) }}" class="nav-link @activeTab('resources.resources')">{{ __('Info') }}</a></li>
    @if($resource->exists)
    <li class="nav-item"><a href="{{ route('resource_capacities.index', ['resource' => $resource]) }}" class="nav-link @activeTab('resources.capacities')">{{ __('Capacity') }}</a></li>
    <li class="nav-item"><a href="{{ route('comments.index', ['resource' => $resource]) }}" class="nav-link @activeTab('resources.comments')">{{ __('Comments') }}</a></li>
    @endif
</ul>

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ $resource->name }}</span>
    <div>
        <x-delete-model :model="$resource" class="btn btn-primary" />
    </div>
</nav>
<ul class="nav nav-tabs bg-light app-nav-section">
    <li class="nav-item"><a href="{{ route('resources.edit', ['resource' => $resource]) }}" class="nav-link @activeTab('resources')">{{ __('Info') }}</a></li>
    @if($resource->exists)
    <li class="nav-item"><a href="{{ route('resource_capacities.index', ['resource' => $resource]) }}" class="nav-link @activeTab('resource_capacities')">{{ __('Capacity') }}</a></li>
    <li class="nav-item"><a href="{{ route('comments.index', ['resource' => $resource]) }}" class="nav-link @activeTab('comments')">{{ __('Comments') }}</a></li>
    @endif
</ul>

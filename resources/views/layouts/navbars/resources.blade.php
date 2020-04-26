@section('sectionnavbar')
<nav id="app-navbar-section" class="navbar navbar-expand-sm navbar-light bg-light">
    <span class="navbar-brand">{{ __('Resources') }}</span>
    <a href="#app-navbar-section" class="navbar-toggler app-navbar-toggler-open" type="button" aria-controls="app-navbar-nav" aria-expanded="false" aria-label="Open navigation">
        <span class="navbar-toggler-icon"></span>
    </a>
    <a href="#app-navbar-collapsed" class="navbar-toggler app-navbar-toggler-close" type="button" aria-controls="app-navbar-nav" aria-expanded="true" aria-label="Close navigation">
        <span class="navbar-toggler-icon"></span>
    </a>
    <div id="app-navbar-section-nav" class="collapsible collapse navbar-collapse navbar-nav">
        <a class="nav-item nav-link" href="{{ route('resources.index') }}">{{ __('Resources') }}</a>
        <a class="nav-item nav-link" href="{{ route('resource_owners.index') }}">{{ __('Owners') }}</a>
    </div>
</nav>
@endsection

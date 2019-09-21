@section('sectionnavbar')
<nav class="navbar navbar-expand-lg navbar-light bg-light app-nav-sub">
    <a class="navbar-brand" href="/resources">{{ __('Resources') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminnavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminnavbar">
        <a class="nav-item nav-link" href="{{ route('resources.resources.index') }}">{{ __('Resources') }}</a>
        <a class="nav-item nav-link" href="{{ route('resources.resource_owners.index') }}">{{ __('Owners') }}</a>
    </div>
</nav>
@endsection
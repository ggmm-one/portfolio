@section('navbar-tertiary')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $resource->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTertiaryResources" aria-controls="navbarTertiaryResources" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTertiaryResources">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('resources.edit', [$resource]) }}">{{ __('Info') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('resource_capacities.index', [$resource]) }}">{{ __('Capacity') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('resources.comments.index', [$resource]) }}">{{ __('Comments') }}</a>
                </ul>
            </div>
    </nav>

@endsection

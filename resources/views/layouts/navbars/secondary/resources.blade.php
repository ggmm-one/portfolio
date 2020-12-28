@section('navbar-secondary')

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ __('Resources') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSecondaryResources" aria-controls="navbarSecondaryResources" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSecondaryResources">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('resources.index') }}">{{ __('Resources') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('resource_owners.index') }}">{{ __('Owners') }}</a>
                </ul>
            </div>
    </nav>

@endsection

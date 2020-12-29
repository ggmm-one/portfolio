@section('navbar-secondary')

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('users.index') }}">{{ __('Admin') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSecondaryAdmin" aria-controls="navbarSecondaryAdmin" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSecondaryAdmin">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('settings.index') }}">{{ __('Settings') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('evaluation_items.index') }}">{{ __('Evaluation') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('resource_types.index') }}">{{ __('Resource Types') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                </ul>
            </div>
        </div>
    </nav>
@endsection

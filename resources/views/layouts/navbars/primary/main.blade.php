@section('navbar-primary')
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrimaryMain" aria-controls="navbarPrimaryMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarPrimaryMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('portfolios.index') }}">{{ __('Portfolios') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('projects.index') }}">{{ __('Projects') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('resources.index') }}">{{ __('Resources') }}</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">{{ __('Admin') }}</a>
                </ul>
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path style="fill:#fff;" d="M16 9v-4l8 7-8 7v-4h-8v-6h8zm-16-7v20h14v-2h-12v-16h12v-2h-14z" />
                        </svg>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </div>
    </nav>
@endsection

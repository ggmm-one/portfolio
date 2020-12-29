@section('navbar-tertiary')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $portfolio->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTertiaryPortfolios" aria-controls="navbarTertiaryPortfolios" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTertiaryPortfolios">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a href="{{ route('portfolios.edit', [$portfolio]) }}" class="nav-link">{{ __('Info') }}</a></li>
                    @if ($portfolio->exists)
                        <li class="nav-item"><a href="{{ route('portfolios.goals.index', [$portfolio]) }}" class="nav-link">{{ __('Strategy and Objectives') }}</a></li>
                        <li class="nav-item"><a href="{{ route('portfolios.reports.index', [$portfolio]) }}" class="nav-link">{{ __('Reports') }}</a></li>
                        <li class="nav-item"><a href="{{ route('portfolios.links.index', [$portfolio]) }}" class="nav-link">{{ __('Links') }}</a></li>
                        <li class="nav-item"><a href="{{ route('portfolios.comments.index', [$portfolio]) }}" class="nav-link">{{ __('Comments') }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

@endsection

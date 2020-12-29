@section('navbar-tertiary')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $project->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTertiaryProjects" aria-controls="navbarTertiaryProjects" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTertiaryProjects">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('projects.edit', compact('project')) }}">{{ __('Info') }}</a>
                        @if ($project->exists)
                    <li class="nav-item"><a class="nav-link" href="{{ route('resource_allocations.index', compact('project')) }}">{{ __('Resources') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('evaluation_scores.index', compact('project')) }}">{{ __('Evaluation') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('project_order_constraints.index', compact('project')) }}">{{ __('Constraints') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('projects.reports.index', compact('project')) }}">{{ __('Reports') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('projects.links.index', compact('project')) }}">{{ __('Links') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('projects.comments.index', compact('project')) }}">{{ __('Comments') }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

@endsection

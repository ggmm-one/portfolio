<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ $portfolioUnit->name }}</span>
    <div class="app-action">
        @if (Request::route()->getName() == 'portfolio_units.edit')
        @if ($portfolioUnit->exists)
        <a href="{{ route('projects.index', ['portfolio_unit' => $portfolioUnit])}}">{{ __('Projects') }}</a>
        <x-delete-model :model="$portfolioUnit" class="btn btn-primary" />
        @endif
        @endif
    </div>
</nav>
<ul class="nav nav-tabs bg-light app-nav-section">
    <li class="nav-item"><a href="{{ route('portfolio_units.edit', ['portfolio_unit' => $portfolioUnit]) }}" class="nav-link @activeTab('portfolio_units.edit')">{{ __('Info') }}</a></li>
    @if ($portfolioUnit->exists)
    <li class="nav-item"><a href="{{ route('portfolio_units.goals.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolio_units.goals')">{{ __('Strategy and Objectives') }}</a></li>
    <li class="nav-item"><a href="{{ route('portfolio_units.reports.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolio_units.reports')">{{ __('Reports') }}</a></li>
    <li class="nav-item"><a href="{{ route('portfolio_units.links.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolio_units.links')">{{ __('Links') }}</a></li>
    <li class="nav-item"><a href="{{ route('portfolio_units.comments.index', ['portfolio_unit' => $portfolioUnit]) }}" class="nav-link @activeTab('portfolio_units.comments')">{{ __('Comments') }}</a></li>
    @endif
</ul>

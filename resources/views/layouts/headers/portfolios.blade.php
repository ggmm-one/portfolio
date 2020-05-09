<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ $portfolioUnit->name }}</span>
    <div class="app-action">
        @if ($portfolioUnit->exists)
        <a href="{{ route('projects.index', ['portfolio_unit' => $portfolioUnit])}}">{{ __('Projects') }}</a>
        <x-delete-model :model="$portfolioUnit" />
        @endif
    </div>
</nav>
<ul class="nav nav-tabs bg-light app-nav-section">
    <li class="nav-item"><a href="{{ route('portfolio_units.edit', ['portfolio_unit' => $portfolioUnit]) }}" class="nav-link @activeTab('portfolios.portfolios')">{{ __('Info') }}</a></li>
    @if ($portfolioUnit->exists)
    <li class="nav-item"><a href="{{ route('comments.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolios.goals')">{{ __('Strategy and Objectives') }}</a></li>
    <li class="nav-item"><a href="{{ route('comments.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolios.reports')">{{ __('Reports') }}</a></li>
    <li class="nav-item"><a href="{{ route('comments.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolios.links')">{{ __('Links') }}</a></li>
    <li class="nav-item"><a href="{{ route('comments.index', ['portfolio_unit' => $portfolioUnit]) }}" class="nav-link @activeTab('comments')">{{ __('Comments') }}</a></li>
    @endif
</ul>

@include('inc.flash_msg')

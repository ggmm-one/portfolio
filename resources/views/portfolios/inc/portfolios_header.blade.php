<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ $portfolioUnit->name }}</span>
    <div class="app-action">
        @if ($portfolioUnit->exists)
            <a href="{{ route('projects.projects.index', ['portfolio_unit' => $portfolioUnit->pid])}}">{{ __('Projects') }}</a>
            @includeWhen(!$portfolioUnit->isRoot() && auth()->user()->can('delete', $portfolioUnit), 'inc.delete_btn', ['deleteAction' => route('portfolios.portfolios.destroy', ['portfolio_unit' => $portfolioUnit->pid])])
        @endif
    </div>
</nav>
<ul class="nav nav-tabs bg-light app-nav-section">
    <li class="nav-item"><a href="{{ route('portfolios.portfolios.edit', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolios.portfolios')">{{ __('Info') }}</a></li>
    @if ($portfolioUnit->exists)
        <li class="nav-item"><a href="{{ route('portfolios.goals.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolios.goals')">{{ __('Strategy and Objectives') }}</a></li>
        <li class="nav-item"><a href="{{ route('portfolios.reports.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolios.reports')">{{ __('Reports') }}</a></li>
        <li class="nav-item"><a href="{{ route('portfolios.links.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolios.links')">{{ __('Links') }}</a></li>
        <li class="nav-item"><a href="{{ route('portfolios.comments.index', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="nav-link @activeTab('portfolios.comments')">{{ __('Comments') }}</a></li>
    @endif
</ul>

@include('inc.flash_msg')
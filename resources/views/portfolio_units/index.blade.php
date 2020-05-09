@extends('layouts.frame_app')

@section('pagetitle', 'Portfolios')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <span class="navbar-brand">{{ __('Portfolios') }}</span>
    @can('create', App\PortfolioUnit::class) <a href="{{ route('portfolio_units.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
</nav>

<table class="table">
    <thead>
        <tr>
            <th>{{ __('Component') }}</th>
            <th>{{ __('Type') }}</th>
            <th>{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @each('portfolio_units.index_item', $portfolioUnits, 'portfolioUnit', 'portfolio_units.index_item_empty')
    </tbody>
</table>

@endsection

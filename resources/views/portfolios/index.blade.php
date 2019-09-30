@extends('layouts.frame_app')

@section('pagetitle', 'Portfolios')
@section('bodyid', 'app-portfolios-portfolio-units-index')

@section('content')

@include('inc.flash_msg')

    <nav class="navbar navbar-light bg-light app-nav-section">
        <span class="navbar-brand">{{ __('Portfolios') }}</span>
        @if (auth()->user()->can('create', App\PortfolioUnit::class)) <a href="{{ route('portfolios.portfolios.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endif
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
        @each('portfolios.index_item', $portfolioUnits, 'portfolioUnit', 'portfolios.index_item_empty')
        </tbody>
    </table>

@endsection

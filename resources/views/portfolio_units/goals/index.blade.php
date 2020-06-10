@extends('layouts.frame_app')

@section('pagetitle', 'Strategy and Objectives')

@section('content')

@include('portfolios.inc.portfolios_header')

<nav class="navbar navbar-light">
    <span class="navbar-brand">&nbsp;</span>
    @can('create', App\PortfolioUnit::class) <a href="{{ route('portfolios.goals.create', ['portfolio_unit' => $portfolioUnit]) }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
</nav>

@include('links.inc.table')

@endsection

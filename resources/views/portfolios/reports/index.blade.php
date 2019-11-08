@extends('layouts.frame_app')

@section('pagetitle', 'Reports')
@section('bodyid', 'app-portfolios-portfolio-reports-index')

@section('content')

    @include('portfolios.inc.portfolios_header')

    <nav class="navbar navbar-light">
        <span class="navbar-brand">&nbsp;</span>
        @can('create', $portfolioUnit) <a href="{{ route('portfolios.reports.create', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
    </nav>

    @include('links.inc.table')

@endsection

@extends('layouts.sections.portfolios')

@section('pagetitle', __('Reports'))
@section('bodyid', 'app-portfolios-portfolio-reports-index')

@section('subcontent')

<nav class="navbar navbar-light">
    <span class="navbar-brand">&nbsp;</span>
    <a href="{{ route('portfolios.reports.create', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a>
</nav>

    @include('links.inc.table')

@endsection

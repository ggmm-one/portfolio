@extends('layouts.frame_app')

@section('pagetitle', 'Links')
@section('bodyid', 'app-portfolios-portfolio-reports-index')

@section('content')

    @include('portfolios.inc.portfolios_header')

    <nav class="navbar navbar-light">
        <span class="navbar-brand">&nbsp;</span>
        @if (auth()->user()->can('create', $portfolioUnit)) <a href="{{ route('portfolios.links.create', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a> @endif
    </nav>

    @include('links.inc.table')

@endsection

@extends('layouts.frame_app')

@section('pagetitle', 'Strategy and Objectives')
@section('bodyid', 'app-portfolios-portfolio-goals-index')

@section('content')

    @include('portfolios.inc.portfolios_header')

    <nav class="navbar navbar-light">
        <span class="navbar-brand">&nbsp;</span>
        <a href="{{ route('portfolios.goals.create', ['portfolio_unit' => $portfolioUnit->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a>
    </nav>

    @include('links.inc.table')

@endsection

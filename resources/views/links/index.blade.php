@extends('layouts.frame_app')

@section('pagetitle', 'Links')

@section('content')

@include('inc.flash_msg')

@includeIf('layouts.navbars.'.$holdingModel->getTable())

@includeIf('layouts.headers.'.$holdingModel->getTable())

<nav class="navbar navbar-light">
    <span class="navbar-brand">&nbsp;</span>
    @can('create', get_class($holdingModel)) <a href="{{ route(str_replace('index', 'create', Request::route()->getName()), Request::route()->parameters()) }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
</nav>

@include('links.inc.table')

@endsection

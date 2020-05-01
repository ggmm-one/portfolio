@extends('layouts.frame_app')

@section('pagetitle', 'Reports')

@section('content')

@include('inc.flash_msg')

@include('projects.inc.projects_header')

<nav class="navbar navbar-light">
    <span class="navbar-brand">&nbsp;</span>
    @can('create', App\Project::class) <a href="{{ route('projects.reports.create', ['project' => $project->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
</nav>

@include('links.inc.table')

@endsection

@extends('layouts.frame_app')

@section('pagetitle', 'Reports')
@section('bodyid', 'app-projects-project-reports-index')

@section('content')

    @include('inc.flash_msg')

    @include('projects.inc.projects_header')

    <nav class="navbar navbar-light">
        <span class="navbar-brand">&nbsp;</span>
        @if (auth()->user()->can('create', App\Project::class)) <a href="{{ route('projects.reports.create', ['project' => $project->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a> @endif
    </nav>

    @include('links.inc.table')

@endsection

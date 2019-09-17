@extends('layouts.sections.projects')

@section('pagetitle', 'Reports')
@section('bodyid', 'app-projects-project-reports-index')

@section('subcontent')

<nav class="navbar navbar-light">
    <span class="navbar-brand">&nbsp;</span>
    <a href="{{ route('projects.reports.create', ['project' => $project->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a>
</nav>

    @include('links.inc.table')

@endsection

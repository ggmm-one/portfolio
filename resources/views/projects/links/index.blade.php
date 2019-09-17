@extends('layouts.sections.projects')

@section('pagetitle', 'Links')
@section('bodyid', 'app-projects-reports-index')

@section('subcontent')

<nav class="navbar navbar-light">
    <span class="navbar-brand">&nbsp;</span>
    <a href="{{ route('projects.links.create', ['project' => $project->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a>
</nav>

    @include('links.inc.table')

@endsection

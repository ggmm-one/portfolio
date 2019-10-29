@extends('layouts.frame_app')

@section('pagetitle', 'Resources')
@section('bodyid', 'app-projects-resources-index')

@section('content')

    @include('inc.flash_msg')

    @include('projects.inc.projects_header')

    <nav class="navbar navbar-light">
        <span class="navbar-brand">&nbsp;</span>
        @can('create', App\ResourceAllocation::class) <a href="{{ route('projects.resources.create', ['project' => $project->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
    </nav>

@endsection
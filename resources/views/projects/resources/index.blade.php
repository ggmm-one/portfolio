@extends('layouts.frame_app')

@section('pagetitle', 'Resources')
@section('bodyid', 'app-projects-resources-index')

@section('content')

    @include('inc.flash_msg')

    @include('projects.inc.projects_header')

    <nav class="navbar navbar-light">
        <span class="navbar-brand">&nbsp;</span>
        @can('create', App\ResourceAllocation::class) <a href="{{ route('projects.resources.create', ['project' => $project->pid]) }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan

        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Resource') }}</th>
                    @foreach(range(1, $project->duration) as $month)
                        <th>{{ __('Month') }} {{ $month }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @includeWhen($allocations->isEmpty(), 'projects.resources.index_empty')
                @includeWhen(!$allocations->isEmpty(), 'projects.resources.index_notempty')
            </tbody>
        </table>
    </nav>

@endsection
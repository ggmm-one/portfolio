@extends('layouts.frame_app')

@section('pagetitle', 'Projects')

@section('content')

@include('inc.flash_msg')

<nav class="navbar navbar-light bg-light app-nav-section">
    <div>
        <span class="navbar-brand">{{ __('Projects') }}</span>
        @include('inc.filtered_tag')
    </div>
    @can('create', App\Project::class) <a href="{{ route('projects.create') }}" class="btn btn-primary">{{ __('Add') }}</a> @endcan
</nav>

<table class="table">
    <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Portfolio') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Score') }}</th>
            <th>{{ __('Type') }}</th>
        </tr>
    </thead>
    <tbody>
        @each('projects.index_item', $projects, 'project', 'projects.index_item_empty')
    </tbody>
</table>

@endsection
